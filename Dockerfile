# Dockerfile
FROM php:8.3-fpm-alpine

# Set working directory
WORKDIR /var/www/html

# Install system dependencies
RUN apk add --no-cache \
    # Database drivers
    libpq-dev \
    mysql-client \
    # Zip extension
    libzip-dev \
    # Intl extension
    icu-dev \
    # Soap extension
    libxml2-dev \
    # Build tools (will be removed)
    autoconf \
    g++ \
    make \
    # Common utilities
    curl \
    git \
    unzip

# Install PHP extensions
RUN docker-php-ext-install -j$(nproc) \
    pdo_mysql \
    pdo_pgsql \
    zip \
    bcmath \
    opcache \
    pcntl \
    exif \
    iconv \
    intl \
    soap

# Clean up build dependencies to keep image small
RUN apk del autoconf g++ make

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy application files
COPY . /var/www/html

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage

EXPOSE 9000
CMD ["php-fpm"]