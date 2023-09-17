FROM php:8.2-fpm

RUN apk add --update --no-cache \
    git \
    linux-headers \
    yarn \
    npm \
    python3 make g++ \
    make\
### Requirements for OpenSSL package
    perl \
    perl-text-template \
### Requirements for PHP package and PHP extensions
    libxml2-dev \
    postgresql-dev \
    icu-dev \
    ### with Curl
    && apk add --no-cache curl-dev \
    ### with GD
    && apk add --no-cache libwebp-dev libjpeg libpng-dev libxml2-dev libzip-dev imagemagick-dev libgomp \
    ### with XDebug
    && git clone --depth 1 https://github.com/xdebug/xdebug.git /usr/src/php/ext/xdebug \
    && docker-php-ext-configure xdebug --enable-xdebug-dev \
    && docker-php-ext-install gd intl opcache xdebug pgsql pdo_pgsql bcmath soap curl \
### Could set the timezones through the environment variables
    && apk add --no-cache -U tzdata \
    && mkdir /home/distr \
### Install composer \
    && cd /home/distr \
    && php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php -r "if (hash_file('sha384', 'composer-setup.php') === '55ce33d7678c5a611085589f1f3ddf8b3c52d662cd01d4ba75c0ee0459970c2200a51f492d557530c71c15d8dba01eae') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" \
    && php composer-setup.php \
    && php -r "unlink('composer-setup.php');" \
    && mv composer.phar /usr/local/bin/composer \
### Install symfony-cli
    && cd /home/distr \
    && wget https://github.com/symfony-cli/symfony-cli/releases/download/v5.5.2/symfony-cli_5.5.2_x86_64.apk \
    && apk add --allow-untrusted ./symfony-cli_5.5.2_x86_64.apk \
### Clean up
    && apk del \
    perl-text-template \
    perl \
    && rm -Rf /home/distr \
    && rm -Rf /usr/etc/* \
### Make dirs
    && mkdir -p /var/www/html \
    && mkdir /.symfony5 \
    && chmod 777 /.symfony5 \
    && mkdir /.yarn \
    && chmod 777 /.yarn \
    && touch /.yarnrc && chmod 666 /.yarnrc \
    && mkdir -p /.config/composer \
    && chmod 777 /.config/composer \
### Define web-root as a safe repository
    && cd /var/www/html && git config --system --add safe.directory /var/www/html

USER 1000

WORKDIR /var/www/html

CMD ["/usr/local/sbin/php-fpm"]
