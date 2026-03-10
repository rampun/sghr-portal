# Dockerfile
FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    # For zip extension
    libzip-dev \
    # For pdo_pgsql
    libpq-dev \
    # For intl
    libicu-dev \
    # For soap
    libxml2-dev \
    # For exif/iconv
    libonig-dev \
    # SSL
    libssl-dev \
    # Utilities
    unzip \
    curl \
    git \
    && rm -rf /var/lib/apt/lists/*

# Fix for xz sandbox issues on newer images [citation:9]
ENV XZ_OPT="--no-auto-sandbox"

# Install PHP extensions
RUN docker-php-ext-install \
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

# Optional: Enable extensions if needed
RUN docker-php-ext-enable \
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

# Verify installations
RUN php -m | grep -E 'pdo_mysql|pdo_pgsql|zip|bcmath|opcache|pcntl|exif|iconv|intl|soap'


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