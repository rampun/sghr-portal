# php.Dockerfile
FROM php:8.3-fpm-alpine

RUN apk add --no-cache --virtual .build-deps \
    $PHPIZE_DEPS \
    freetype-dev libjpeg-turbo-dev libpng-dev zlib-dev libwebp-dev \
    icu-dev libzip-dev postgresql-dev oniguruma-dev libxml2-dev \
    && apk add --no-cache \
    git curl mysql-client \
    freetype libjpeg-turbo libpng zlib libwebp \
    icu-libs libzip libpq libxml2 oniguruma \
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install -j"$(nproc)" gd pdo_mysql pdo_pgsql zip bcmath opcache pcntl exif intl soap \
    && apk del .build-deps


# Set working directory
WORKDIR /var/www/html

# Copy application files (optional, can be done via volume mount in docker-compose)
COPY . .

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer


# Expose port 9000 for PHP-FPM
EXPOSE 9000

# Start PHP-FPM
CMD ["php-fpm"]