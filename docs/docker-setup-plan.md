# Docker環境構築計画書

## 1. 概要

本プロジェクト（my-memo-app）のDocker環境を構築し、開発環境の統一と環境構築の簡易化を実現する。

## 2. 現在のプロジェクト構成

### 技術スタック
- **バックエンド**: PHP 8.2.11 / Laravel 10.30.1
- **フロントエンド**: Node v21.1.0 / npm 10.2.0 / Vite / Tailwind CSS
- **データベース**: MySQL 5.7
- **Webサーバー**: Apache 2.4.54
- **その他**: Jetstream 4.0, Livewire 3.0

### 主要機能
- ユーザー登録・ログイン機能
- メモの作成・編集・削除
- カテゴリ管理（メイン/サブカテゴリ）
- 検索機能

## 3. Docker構成

### 3.1 コンテナ構成

以下の4つのコンテナで構成する：

#### (1) Webサーバーコンテナ（nginx）
- **イメージ**: nginx:alpine
- **役割**: リバースプロキシ、静的ファイル配信
- **ポート**: 80 (ホスト側は8000などに変更可能)
- **設定**: Laravel用のnginx設定ファイルを作成

#### (2) アプリケーションコンテナ（PHP-FPM）
- **イメージ**: php:8.2-fpm
- **役割**: PHPアプリケーションの実行
- **必要な拡張機能**:
  - pdo_mysql
  - mbstring
  - zip
  - exif
  - pcntl
  - bcmath
  - gd
  - redis (キャッシュ用、オプション)
- **追加ツール**: Composer

#### (3) データベースコンテナ（MySQL）
- **イメージ**: mysql:5.7
- **役割**: データ永続化
- **ポート**: 3306
- **ボリューム**: データの永続化用

#### (4) Node.jsコンテナ（開発時のみ）
- **イメージ**: node:21-alpine
- **役割**: Viteの開発サーバー、アセットのビルド
- **ポート**: 5173 (Vite開発サーバー)

## 4. 必要なファイル

### 4.1 Dockerファイル

#### `docker/php/Dockerfile`
PHPコンテナ用のDockerfile
- ベースイメージ: php:8.2-fpm
- 必要な拡張機能のインストール
- Composerのインストール
- 作業ディレクトリの設定

#### `docker/nginx/Dockerfile`
Nginxコンテナ用のDockerfile（必要に応じて）

### 4.2 設定ファイル

#### `docker/nginx/default.conf`
Nginx設定ファイル
- Laravel用のルーティング設定
- PHP-FPMへのプロキシ設定

#### `docker/mysql/my.cnf`
MySQL設定ファイル（オプション）
- 文字コード設定（UTF-8）
- その他のパフォーマンス設定

### 4.3 Docker Compose

#### `docker-compose.yml`
全コンテナの定義と連携設定
- サービス定義（nginx, php, mysql, node）
- ネットワーク設定
- ボリューム設定
- 環境変数設定

### 4.4 環境変数

#### `.env.example`の更新
Docker環境用の設定を追加
```
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=my_memo_app
DB_USERNAME=memo_user
DB_PASSWORD=secret

VITE_HOST=0.0.0.0
VITE_PORT=5173
```

## 5. ディレクトリ構造

```
my-memo-app/
├── docker/
│   ├── nginx/
│   │   ├── Dockerfile
│   │   └── default.conf
│   ├── php/
│   │   └── Dockerfile
│   └── mysql/
│       └── my.cnf
├── docker-compose.yml
├── .env
├── .env.example
└── docs/
    └── docker-setup-plan.md (本ファイル)
```

## 6. 構築手順

### 6.1 準備フェーズ
1. `docker/` ディレクトリ構造の作成
2. 各種Dockerfileの作成
3. Nginx設定ファイルの作成
4. MySQL設定ファイルの作成（オプション）
5. `docker-compose.yml` の作成

### 6.2 設定フェーズ
1. `.env.example` の更新
2. `.env` ファイルの作成（`.env.example`からコピー）
3. `.gitignore` の確認・更新

### 6.3 ビルドフェーズ
1. Dockerイメージのビルド
   ```bash
   docker-compose build
   ```

### 6.4 起動・初期化フェーズ
1. コンテナの起動
   ```bash
   docker-compose up -d
   ```

2. Composer依存関係のインストール
   ```bash
   docker-compose exec php composer install
   ```

3. npm依存関係のインストール
   ```bash
   docker-compose exec node npm install
   ```

4. アプリケーションキーの生成
   ```bash
   docker-compose exec php php artisan key:generate
   ```

5. データベースマイグレーション
   ```bash
   docker-compose exec php php artisan migrate
   ```

6. ストレージのシンボリックリンク作成
   ```bash
   docker-compose exec php php artisan storage:link
   ```

### 6.5 開発サーバーの起動
1. Vite開発サーバーの起動
   ```bash
   docker-compose exec node npm run dev
   ```

## 7. 便利なMakefileの作成（オプション）

よく使うコマンドをまとめたMakefileを作成すると便利：
- `make build`: イメージのビルド
- `make up`: コンテナの起動
- `make down`: コンテナの停止
- `make install`: 初期セットアップ
- `make migrate`: マイグレーション実行
- `make fresh`: データベースのリフレッシュ

## 8. 注意事項

### 8.1 パーミッション
- `storage/` と `bootstrap/cache/` ディレクトリの書き込み権限
- Docker内のユーザーとホストユーザーのUID/GID対応

### 8.2 開発時のホットリロード
- Viteの設定でDocker環境でも正しく動作するように設定が必要
- `vite.config.js` の `server.host` と `server.hmr` の設定

### 8.3 データ永続化
- MySQLデータは名前付きボリュームで永続化
- `docker-compose down -v` を実行するとデータが削除されるので注意

## 9. セキュリティ考慮事項

1. `.env` ファイルは `.gitignore` に含める
2. 本番環境では異なる設定を使用
3. データベースのパスワードは強固なものを使用
4. ポート公開は必要最小限に

## 10. 今後の拡張性

### 10.1 追加検討項目
- Redis（キャッシュ・セッション管理）
- Mailhog（メール開発環境）
- phpMyAdmin（データベース管理UI）
- Laravel Horizon（キュー管理）

### 10.2 本番環境対応
- 本番用 `docker-compose.prod.yml` の作成
- CI/CDパイプラインとの統合
- コンテナのセキュリティスキャン

## 11. タイムライン

1. **Phase 1**: Docker基本構成の作成（nginx, php, mysql）
2. **Phase 2**: Node.js環境の追加とVite設定
3. **Phase 3**: 動作確認とドキュメント整備
4. **Phase 4**: 便利ツール（Makefile等）の追加

## 12. 参考資料

- Laravel公式ドキュメント: https://laravel.com/docs/10.x/deployment
- Docker公式ドキュメント: https://docs.docker.com/
- Vite公式ドキュメント: https://vitejs.dev/config/

---

**作成日**: 2026-01-20
**対象プロジェクト**: my-memo-app
**対象バージョン**: Laravel 10.30.1
