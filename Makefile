.PHONY: help build up down restart logs ps install migrate fresh seed test clean setup check-ports

# デフォルトターゲット
help:
	@echo "利用可能なコマンド:"
	@echo "  make setup       - 初回セットアップ（.env作成、ビルド、起動、初期化）"
	@echo "  make check-ports - ポート競合チェック（自動的に空きポートを見つける）"
	@echo "  make build       - Dockerイメージのビルド"
	@echo "  make up          - コンテナの起動"
	@echo "  make down        - コンテナの停止"
	@echo "  make restart     - コンテナの再起動"
	@echo "  make logs        - ログの表示"
	@echo "  make ps          - コンテナの状態確認"
	@echo "  make install     - 依存関係のインストール（Composer + npm）"
	@echo "  make migrate     - データベースマイグレーション実行"
	@echo "  make fresh       - データベースのリフレッシュ（全削除＆マイグレーション）"
	@echo "  make seed        - シーダーの実行"
	@echo "  make test        - テストの実行"
	@echo "  make clean       - コンテナとボリュームの削除"
	@echo "  make shell-php   - PHPコンテナのシェルに入る"
	@echo "  make shell-node  - Nodeコンテナのシェルに入る"
	@echo "  make tinker      - Laravel Tinkerの起動"
	@echo "  make optimize    - キャッシュのクリアと最適化"

# ポート競合チェック
check-ports:
	@bash scripts/check-ports.sh

# 初回セットアップ
setup:
	@if [ ! -f .env ]; then \
		echo ".envファイルを作成中..."; \
		cp .env.example .env; \
	fi
	@echo "ポート競合をチェック中..."
	@bash scripts/check-ports.sh
	@echo ""
	@echo "Dockerイメージをビルド中..."
	docker-compose build
	@echo "コンテナを起動中..."
	docker-compose up -d
	@echo "Composer依存関係をインストール中..."
	docker-compose exec php composer install
	@echo "npm依存関係をインストール中..."
	docker-compose exec node npm install
	@echo "アプリケーションキーを生成中..."
	docker-compose exec php php artisan key:generate
	@echo "データベースマイグレーションを実行中..."
	docker-compose exec php php artisan migrate
	@echo "ストレージリンクを作成中..."
	docker-compose exec php php artisan storage:link
	@echo ""
	@echo "======================================"
	@echo "  セットアップ完了！"
	@echo "======================================"
	@bash -c 'source .env 2>/dev/null && echo "アプリケーションURL: http://localhost:$${APP_PORT:-8000}"'
	@bash -c 'source .env 2>/dev/null && echo "Vite開発サーバー: http://localhost:$${VITE_PORT:-5173}"'
	@bash -c 'source .env 2>/dev/null && echo "MySQL接続ポート: $${MYSQL_PORT:-3307}"'

# イメージのビルド
build:
	docker-compose build

# コンテナの起動
up:
	docker-compose up -d

# コンテナの停止
down:
	docker-compose down

# コンテナの再起動
restart:
	docker-compose restart

# ログの表示
logs:
	docker-compose logs -f

# コンテナの状態確認
ps:
	docker-compose ps

# 依存関係のインストール
install:
	docker-compose exec php composer install
	docker-compose exec node npm install

# マイグレーション実行
migrate:
	docker-compose exec php php artisan migrate

# データベースのリフレッシュ
fresh:
	docker-compose exec php php artisan migrate:fresh

# シーダー実行
seed:
	docker-compose exec php php artisan db:seed

# テスト実行
test:
	docker-compose exec php php artisan test

# コンテナとボリュームの削除
clean:
	docker-compose down -v
	@echo "全てのコンテナとボリュームを削除しました"

# PHPコンテナのシェル
shell-php:
	docker-compose exec php bash

# Nodeコンテナのシェル
shell-node:
	docker-compose exec node sh

# Laravel Tinker
tinker:
	docker-compose exec php php artisan tinker

# キャッシュのクリアと最適化
optimize:
	docker-compose exec php php artisan config:clear
	docker-compose exec php php artisan cache:clear
	docker-compose exec php php artisan route:clear
	docker-compose exec php php artisan view:clear
	docker-compose exec php php artisan config:cache
	docker-compose exec php php artisan route:cache
	@echo "最適化完了"

# アセットのビルド
build-assets:
	docker-compose exec node npm run build

# Vite開発サーバーの起動
dev:
	docker-compose exec node npm run dev
