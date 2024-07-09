# ベースの設定
FROM php:8.3-fpm

# cd のかわり
WORKDIR /app
COPY . /app

# composerのインストールと設定
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_HOME "/opt/composer"
ENV PATH "$PATH:/opt/composer/vendor/bin"

RUN apt-get update
RUN apt-get -y install git
RUN apt-get -y install unzip
RUN apt-get -y install libzip-dev
RUN docker-php-ext-install zip

RUN composer install

EXPOSE 8000
CMD ["php","artisan","serve","--host","0.0.0.0"]