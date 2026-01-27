FROM php:8.2-fpm

# 作業ディレクトリの設定
WORKDIR /var/www/html

# 必要なパッケージのインストール
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Composerのインストール
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# PHPユーザーの作成（ホストのユーザーと一致させるため）
ARG UID=1000
ARG GID=1000
RUN groupmod -g ${GID} www-data && \
    usermod -u ${UID} -g www-data www-data

# アプリケーションファイルのコピー
COPY --chown=www-data:www-data . /var/www/html

# パーミッションの設定
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# ユーザーの切り替え
USER www-data

# PHP-FPMの起動
CMD ["php-fpm"]
