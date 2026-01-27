#!/bin/bash

# ポート競合チェックスクリプト
# 使用中のポートを検出し、空いているポートを見つけて.envファイルに設定する

set -e

# 色の定義
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# .envファイルのパス
ENV_FILE=".env"
ENV_EXAMPLE=".env.example"

echo "======================================"
echo "  ポート競合チェックスクリプト"
echo "======================================"
echo ""

# ポートが使用中かチェックする関数
check_port() {
    local port=$1
    if lsof -Pi :$port -sTCP:LISTEN -t >/dev/null 2>&1 ; then
        return 1  # 使用中
    else
        return 0  # 空いている
    fi
}

# 空いているポートを見つける関数
find_available_port() {
    local start_port=$1
    local port=$start_port

    while [ $port -lt $((start_port + 100)) ]; do
        if check_port $port; then
            echo $port
            return 0
        fi
        port=$((port + 1))
    done

    echo ""
    return 1
}

# ポート情報を表示する関数
show_port_status() {
    local service=$1
    local port=$2
    local status=$3

    if [ "$status" = "ok" ]; then
        echo -e "${GREEN}✓${NC} $service: ポート $port は利用可能です"
    elif [ "$status" = "conflict" ]; then
        echo -e "${RED}✗${NC} $service: ポート $port は既に使用されています"
    elif [ "$status" = "changed" ]; then
        echo -e "${YELLOW}→${NC} $service: ポート $port に変更しました"
    fi
}

# デフォルトポート設定
DEFAULT_APP_PORT=8000
DEFAULT_MYSQL_PORT=3307
DEFAULT_VITE_PORT=5173

# .envファイルから現在の設定を読み込む（存在する場合）
# UID/GIDは特殊変数なので除外して読み込む
if [ -f "$ENV_FILE" ]; then
    set +e
    while IFS='=' read -r key value; do
        # コメント行と空行をスキップ
        [[ $key =~ ^#.* ]] && continue
        [[ -z $key ]] && continue
        # UID/GIDは除外（シェルの特殊変数のため）
        [[ $key == "UID" || $key == "GID" ]] && continue
        # 値の前後の引用符を除去
        value=$(echo "$value" | sed -e 's/^"//' -e 's/"$//' -e "s/^'//" -e "s/'$//")
        # 環境変数として設定
        export "$key"="$value"
    done < "$ENV_FILE"
    set -e
fi

# 現在の設定を取得（.envになければデフォルト値を使用）
CURRENT_APP_PORT=${APP_PORT:-$DEFAULT_APP_PORT}
CURRENT_MYSQL_PORT=${MYSQL_PORT:-$DEFAULT_MYSQL_PORT}
CURRENT_VITE_PORT=${VITE_PORT:-$DEFAULT_VITE_PORT}

echo "現在の設定:"
echo "  - アプリケーション: $CURRENT_APP_PORT"
echo "  - MySQL: $CURRENT_MYSQL_PORT"
echo "  - Vite: $CURRENT_VITE_PORT"
echo ""

# ポートチェック
APP_PORT=$CURRENT_APP_PORT
MYSQL_PORT=$CURRENT_MYSQL_PORT
VITE_PORT=$CURRENT_VITE_PORT

HAS_CONFLICT=false

# アプリケーションポートのチェック
echo "ポート使用状況をチェック中..."
if check_port $APP_PORT; then
    show_port_status "アプリケーション" $APP_PORT "ok"
else
    show_port_status "アプリケーション" $APP_PORT "conflict"
    NEW_PORT=$(find_available_port $DEFAULT_APP_PORT)
    if [ -n "$NEW_PORT" ]; then
        APP_PORT=$NEW_PORT
        show_port_status "アプリケーション" $APP_PORT "changed"
        HAS_CONFLICT=true
    else
        echo -e "${RED}エラー: 利用可能なポートが見つかりませんでした${NC}"
        exit 1
    fi
fi

# MySQLポートのチェック
if check_port $MYSQL_PORT; then
    show_port_status "MySQL" $MYSQL_PORT "ok"
else
    show_port_status "MySQL" $MYSQL_PORT "conflict"
    NEW_PORT=$(find_available_port $DEFAULT_MYSQL_PORT)
    if [ -n "$NEW_PORT" ]; then
        MYSQL_PORT=$NEW_PORT
        show_port_status "MySQL" $MYSQL_PORT "changed"
        HAS_CONFLICT=true
    else
        echo -e "${RED}エラー: 利用可能なポートが見つかりませんでした${NC}"
        exit 1
    fi
fi

# Viteポートのチェック
if check_port $VITE_PORT; then
    show_port_status "Vite" $VITE_PORT "ok"
else
    show_port_status "Vite" $VITE_PORT "conflict"
    NEW_PORT=$(find_available_port $DEFAULT_VITE_PORT)
    if [ -n "$NEW_PORT" ]; then
        VITE_PORT=$NEW_PORT
        show_port_status "Vite" $VITE_PORT "changed"
        HAS_CONFLICT=true
    else
        echo -e "${RED}エラー: 利用可能なポートが見つかりませんでした${NC}"
        exit 1
    fi
fi

echo ""

# .envファイルの更新が必要な場合
if [ "$HAS_CONFLICT" = true ] || [ ! -f "$ENV_FILE" ]; then
    echo "======================================"
    echo ".envファイルにポート設定を書き込みます"
    echo "======================================"

    # .envファイルが存在しない場合は.env.exampleからコピー
    if [ ! -f "$ENV_FILE" ]; then
        if [ -f "$ENV_EXAMPLE" ]; then
            echo ".env.exampleから.envを作成します..."
            cp "$ENV_EXAMPLE" "$ENV_FILE"
        else
            echo ".envファイルを新規作成します..."
            touch "$ENV_FILE"
        fi
    fi

    # ポート設定を更新または追加
    update_or_add_env() {
        local key=$1
        local value=$2
        local file=$3

        if grep -q "^${key}=" "$file" 2>/dev/null; then
            # 既存の設定を更新（macOS/BSD sed対応）
            if [[ "$OSTYPE" == "darwin"* ]]; then
                sed -i '' "s/^${key}=.*/${key}=${value}/" "$file"
            else
                sed -i "s/^${key}=.*/${key}=${value}/" "$file"
            fi
        else
            # 新規追加
            echo "${key}=${value}" >> "$file"
        fi
    }

    update_or_add_env "APP_PORT" "$APP_PORT" "$ENV_FILE"
    update_or_add_env "MYSQL_PORT" "$MYSQL_PORT" "$ENV_FILE"
    update_or_add_env "VITE_PORT" "$VITE_PORT" "$ENV_FILE"

    echo -e "${GREEN}✓${NC} .envファイルを更新しました"
    echo ""
    echo "設定されたポート:"
    echo "  - アプリケーション: http://localhost:$APP_PORT"
    echo "  - MySQL: localhost:$MYSQL_PORT"
    echo "  - Vite: http://localhost:$VITE_PORT"
else
    echo -e "${GREEN}✓${NC} 全てのポートが利用可能です！"
    echo ""
    echo "アクセスURL:"
    echo "  - アプリケーション: http://localhost:$APP_PORT"
    echo "  - MySQL: localhost:$MYSQL_PORT"
    echo "  - Vite: http://localhost:$VITE_PORT"
fi

echo ""
echo "======================================"
echo "  チェック完了"
echo "======================================"
