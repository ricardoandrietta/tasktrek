FROM phpdockerio/php:8.3-fpm
WORKDIR "/src"

RUN apt-get update \
    && apt-get -y --no-install-recommends install \
        git \
        bash \
        vim \
        php8.3-mysql \
        php8.3-redis \
        php8.3-uuid \
        php8.3-xdebug \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

## Add composer
RUN curl -sS https://getcomposer.org/installer | \
    php -- --install-dir=/usr/bin/ --filename=composer
