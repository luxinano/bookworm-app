FROM php:7.4-fpm-alpine

WORKDIR /app

RUN set -ex \
	&& apk --no-cache add postgresql-libs postgresql-dev \
	&& docker-php-ext-install pgsql pdo pdo_pgsql \
	&& apk del postgresql-dev

RUN curl -sS https://getcomposer.org/installer | php -- \
    --install-dir=/usr/local/bin --filename=composer
