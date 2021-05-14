FROM php:7.4-fpm

ARG uid=1000
ARG login="dev"

COPY "./xdebug.ini" "/usr/local/etc/php/conf.d/xdebug.ini"

RUN apt-get update \
&&  apt-get upgrade -y \
&&  apt-get install -y \
    wget \
    zip \
    git \
    libicu-dev \
    zlib1g-dev \
    libpng-dev \
&&  docker-php-ext-install \
    pdo_mysql \
    intl \
    gd \
&&  pecl install \
    xdebug-2.8.1 \
&&  docker-php-ext-enable \
    pdo_mysql \
    intl \
    gd \
    xdebug \
&&  wget -O "/usr/local/bin/composer" "https://getcomposer.org/composer-stable.phar" \
&&  chmod -R 755 "/usr/local/bin" \
&&  useradd --create-home --user-group --uid=$uid $login
