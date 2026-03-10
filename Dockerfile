# Dockerfile
FROM php:8.3-fpm-alpine

# Set working directory
WORKDIR /var/www/html

# Install system dependencies for all PHP extensions
RUN apk add --no-cache \
    # For pdo_mysql, pdo_pgsql
    libpq-dev \
    mysql-client \
    # For zip
    libzip-dev \
    # For intl
    icu-dev \
    icu-libs \
    # For soap
    libxml2-dev \
    # For gd (if you need it later)
    freetype-dev \
    libjpeg-turbo-dev \
    libpng-dev \
    # Build tools (will be removed)
    autoconf \
    g++ \
    make \
    $PHPIZE_DEPS \
    # Install PHP extensions
    && docker-php-ext-install -j$(nproc) \
    pdo_mysql \
    pdo_pgsql \
    zip \
    bcmath \
    opcache \
    pcntl \
    exif \
    iconv \
    intl \
    soap \
    # Clean up build dependencies to keep image small
    && apk del autoconf g++ make $PHPIZE_DEPS

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy application files
COPY . /var/www/html

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage

EXPOSE 9000
CMD ["php-fpm"]