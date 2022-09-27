FROM phpdockerio/php:8.1-fpm
WORKDIR "/application"

RUN apt-get update; \
    apt-get -y install \
        git \
        php8.1-gd \
        php8.1-gmp \
        php8.1-mysql \
        php8.1-psr \
        php8.1-redis \
        php8.1-sqlite3 \
        php8.1-xdebug; \
    apt-get clean; \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/* \

RUN docker-php-ext-install mysqli pdo pdo_mysql