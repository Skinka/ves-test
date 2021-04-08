FROM php:7.4-fpm-alpine

RUN set -xe \
    && apk add --update icu && apk add --no-cache \
        autoconf wget grep composer nodejs npm build-base zlib-dev icu-dev zip unzip git curl \
        coreutils freetype-dev libzip-dev libltdl libmcrypt-dev mysql-dev libxml2-dev

RUN docker-php-ext-configure intl && docker-php-ext-install intl
RUN docker-php-ext-configure bcmath --enable-bcmath && docker-php-ext-install bcmath
RUN docker-php-ext-configure pcntl --enable-pcntl && docker-php-ext-install pcntl
RUN docker-php-ext-configure pdo_mysql && docker-php-ext-install pdo pdo_mysql
RUN docker-php-ext-configure gd && docker-php-ext-install gd
RUN docker-php-ext-configure exif && docker-php-ext-install exif
RUN docker-php-ext-configure zip && docker-php-ext-install zip
RUN docker-php-ext-install tokenizer xml

RUN pecl channel-update pecl.php.net
RUN pecl install mcrypt-1.0.3 && docker-php-ext-enable mcrypt

RUN chmod 777 /tmp
RUN mkdir /run/php-fpm && chmod 755 /run/php-fpm

COPY php.ini /etc/php.d/50-setting.ini
COPY www.conf /etc/php-fpm.d/www.conf

WORKDIR /var/www

EXPOSE 9000
ENTRYPOINT ["php-fpm"]
