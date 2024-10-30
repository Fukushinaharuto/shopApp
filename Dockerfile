# ベースの設定
FROM php:8.3-fpm

# 作業ディレクトリの設定
WORKDIR /app
COPY . /app

# composerのインストールと設定
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_HOME "/opt/composer"
ENV PATH "$PATH:/opt/composer/vendor/bin"

# 必要なパッケージのインストールと docker-compose のインストール
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    nodejs \
    npm \
    curl \
    && docker-php-ext-install bcmath zip \
    && curl -L "https://github.com/docker/compose/releases/download/v2.0.1/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose \
    && chmod +x /usr/local/bin/docker-compose

# composer install の実行
RUN composer install
# ポートを公開
EXPOSE 8000

# アプリケーションを起動
CMD ["php", "artisan", "serve", "--host", "0.0.0.0"]