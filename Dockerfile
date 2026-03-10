# Dockerfile
FROM php:8.3-fpm-alpine

# Set working directory
WORKDIR /var/www/html

# Download and use the community installer
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod +x /usr/local/bin/install-php-extensions && \
    install-php-extensions \
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
# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy application files
COPY . /var/www/html

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage

EXPOSE 9000
CMD ["php-fpm"]