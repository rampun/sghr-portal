FROM php:8.2-fpm-alpine

# 1) Build deps (compiler, make, autoconf, etc.)
RUN apk add --no-cache --virtual .build-deps $PHPIZE_DEPS

# 2) Libs needed by extensions (add/remove as needed)
RUN apk add --no-cache \
    freetype-dev libjpeg-turbo-dev libpng-dev zlib-dev libwebp-dev \
    icu-dev libzip-dev libxml2-dev oniguruma-dev \
    postgresql-dev

# 3) Build GD first (so you see clear failures here)
RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install -j"$(nproc)" gd

# 4) Build the rest
RUN docker-php-ext-install pdo_mysql pdo_pgsql zip bcmath opcache pcntl exif iconv intl soap

# 5) Cleanup
RUN apk del .build-deps