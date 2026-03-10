FROM php:8.2-fpm-alpine

# Build deps + libraries required for GD/intl/zip/soap + Postgres client headers
RUN apk add --no-cache --virtual .build-deps $PHPIZE_DEPS \
    && apk add --no-cache \
    freetype-dev libjpeg-turbo-dev libpng-dev zlib-dev libwebp-dev \
    icu-dev libzip-dev libxml2-dev oniguruma-dev \
    postgresql-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install -j"$(nproc)" \
    gd pdo_mysql pdo_pgsql zip bcmath opcache pcntl exif iconv intl soap \
    && apk del .build-deps



# 5) Cleanup
RUN apk del .build-deps