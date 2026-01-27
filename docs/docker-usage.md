# Docker環境の使い方

## 前提条件

以下がインストールされていることを確認してください：
- Docker Desktop（または Docker Engine + Docker Compose）
- Make（オプション、ただし推奨）

## クイックスタート

### 1. 初回セットアップ

プロジェクトルートで以下のコマンドを実行してください：

```bash
make setup
```

このコマンドは以下を自動的に実行します：
- `.env`ファイルの作成
- Dockerイメージのビルド
- コンテナの起動
- Composer依存関係のインストール
- npm依存関係のインストール
- アプリケーションキーの生成
- データベースマイグレーション
- ストレージリンクの作成

### 2. アプリケーションへのアクセス

セットアップ完了後、以下のURLでアクセスできます：
- **アプリケーション**: http://localhost:8000
- **Vite開発サーバー**: http://localhost:5173

## よく使うコマンド

### コンテナの操作

```bash
# コンテナの起動
make up

# コンテナの停止
make down

# コンテナの再起動
make restart

# コンテナの状態確認
make ps

# ログの確認（リアルタイム）
make logs
```

### アプリケーション操作

```bash
# データベースマイグレーション
make migrate

# データベースのリフレッシュ（全削除＆再作成）
make fresh

# シーダーの実行
make seed

# テストの実行
make test

# キャッシュクリアと最適化
make optimize
```

### 開発作業

```bash
# PHPコンテナのシェルに入る
make shell-php

# Nodeコンテナのシェルに入る
make shell-node

# Laravel Tinkerの起動
make tinker

# アセットのビルド（本番用）
make build-assets

# Vite開発サーバーの起動
make dev
```

### クリーンアップ

```bash
# 全てのコンテナとボリュームを削除
make clean
```

## Makeを使わない場合

Makeが使えない環境では、以下のdocker-composeコマンドを直接使用できます：

```bash
# イメージのビルド
docker-compose build

# コンテナの起動
docker-compose up -d

# コンテナの停止
docker-compose down

# ログの表示
docker-compose logs -f

# PHPコンテナでコマンド実行
docker-compose exec php php artisan migrate

# Composerのインストール
docker-compose exec php composer install

# npmのインストール
docker-compose exec node npm install
```

## トラブルシューティング

### ポート競合エラー

既にポート8000や3306が使用されている場合、`docker-compose.yml`のポート設定を変更してください：

```yaml
nginx:
  ports:
    - "8080:80"  # 8000 → 8080に変更

mysql:
  ports:
    - "3307:3306"  # 3306 → 3307に変更
```

### パーミッションエラー

`storage/`や`bootstrap/cache/`のパーミッションエラーが出る場合：

```bash
# PHPコンテナ内で実行
docker-compose exec php chmod -R 777 storage bootstrap/cache
```

または、`.env`ファイルでUID/GIDを調整：

```env
UID=1000  # 自分のUID
GID=1000  # 自分のGID
```

UID/GIDは以下のコマンドで確認できます：

```bash
id -u  # UID
id -g  # GID
```

### データベース接続エラー

1. MySQLコンテナが起動しているか確認：
   ```bash
   docker-compose ps
   ```

2. `.env`ファイルの設定を確認：
   ```env
   DB_HOST=mysql
   DB_PORT=3306
   DB_DATABASE=my_memo_app
   DB_USERNAME=memo_user
   DB_PASSWORD=secret
   ```

3. データベースの初期化：
   ```bash
   make fresh
   ```

### Viteのホットリロードが動作しない

1. `vite.config.js`の設定を確認
2. ブラウザのキャッシュをクリア
3. Nodeコンテナを再起動：
   ```bash
   docker-compose restart node
   ```

### Composerやnpmの依存関係エラー

依存関係を再インストール：

```bash
make install
```

または個別に：

```bash
docker-compose exec php composer install
docker-compose exec node npm install
```

## コンテナ構成

本プロジェクトは以下の4つのコンテナで構成されています：

1. **nginx** - Webサーバー（ポート8000）
2. **php** - PHPアプリケーション（PHP 8.2-FPM）
3. **mysql** - データベース（MySQL 5.7、ポート3306）
4. **node** - フロントエンド開発サーバー（Node.js 21、ポート5173）

## ディレクトリ構造

```
my-memo-app/
├── docker/
│   ├── nginx/
│   │   └── default.conf      # Nginx設定
│   ├── php/
│   │   └── Dockerfile        # PHP Dockerfile
│   └── mysql/
│       └── my.cnf            # MySQL設定
├── docker-compose.yml        # Docker Compose設定
├── Makefile                  # 便利コマンド集
├── .env.example              # 環境変数テンプレート
└── docs/
    ├── docker-setup-plan.md  # 構築計画書
    └── docker-usage.md       # 本ファイル
```

## 本番環境への注意

このDocker設定は開発環境用です。本番環境では以下を考慮してください：

- セキュリティ設定の強化
- パフォーマンスチューニング
- データベースのバックアップ戦略
- SSL/TLS証明書の設定
- 環境変数の適切な管理
- ログローテーション設定

## 参考リンク

- [Docker公式ドキュメント](https://docs.docker.com/)
- [Laravel公式ドキュメント](https://laravel.com/docs/10.x)
- [Vite公式ドキュメント](https://vitejs.dev/)
