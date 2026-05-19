# syntax=docker/dockerfile:1.7
# Multi-stage Dockerfile for sghr-app.
# Targets:
#   dev  - source bind-mounted via compose, deps installed by entrypoint/IDE
#   prod - self-contained image with composer deps + built Vite assets
#
# Build:
#   docker build --target dev  -t sghr-app:dev  .
#   docker build --target prod -t sghr-app:prod .
# (Normally invoked via docker compose.)

# ---------------------------------------------------------------------------
# Stage 1: build frontend assets (Vite + Tailwind v4)
# ---------------------------------------------------------------------------
FROM node:20-alpine AS node-builder
WORKDIR /app

COPY package.json package-lock.json ./
RUN npm ci

# Vite needs the blade templates (Tailwind v4 scans them via the Laravel
# plugin) plus the JS/CSS entrypoints. Copy the whole project — npm/composer
# stuff is excluded via .dockerignore.
COPY vite.config.js ./
COPY resources/ ./resources/
COPY public/ ./public/

RUN npm run build

# ---------------------------------------------------------------------------
# Stage 2: PHP base — extensions + Composer, shared by dev and prod
# ---------------------------------------------------------------------------
FROM php:8.3-fpm-alpine AS php-base

RUN apk add --no-cache \
    bash \
    curl \
    git \
    zip \
    unzip \
    libzip-dev \
    libpng-dev \
    libxml2-dev \
    oniguruma-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    icu-dev \
    libxslt-dev \
    shadow

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod +x /usr/local/bin/install-php-extensions && \
    install-php-extensions \
        pdo_mysql \
        zip \
        bcmath \
        opcache \
        pcntl \
        exif \
        intl \
        soap \
        gd \
        redis

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# PHP runtime tuning shared by both targets.
RUN { \
        echo "upload_max_filesize = 100M"; \
        echo "post_max_size = 100M"; \
        echo "memory_limit = 512M"; \
        echo "max_execution_time = 300"; \
        echo "max_input_time = 300"; \
    } > /usr/local/etc/php/conf.d/zz-app.ini

WORKDIR /var/www/html

COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["php-fpm"]

# ---------------------------------------------------------------------------
# Stage 3: dev — minimal, source comes in via bind mount from compose
# ---------------------------------------------------------------------------
FROM php-base AS dev

# xdebug for breakpoints. Disabled by default; enable per-request via
# XDEBUG_TRIGGER=1 from the client.
RUN install-php-extensions xdebug && \
    { \
        echo "xdebug.mode=develop,debug"; \
        echo "xdebug.start_with_request=trigger"; \
        echo "xdebug.client_host=host.docker.internal"; \
    } > /usr/local/etc/php/conf.d/xdebug.ini

# Pre-create the writable dirs so the bind mount inherits sane perms when
# the host directories don't exist yet (fresh clone).
RUN mkdir -p storage/framework/sessions storage/framework/views \
             storage/framework/cache storage/logs storage/app \
             bootstrap/cache public/build \
    && chown -R www-data:www-data storage bootstrap/cache public

# No COPY of source — compose bind-mounts ./ over /var/www/html.
# No composer install — run `make composer-install` inside the container
# the first time (or it's already there from the host).

EXPOSE 9000

# ---------------------------------------------------------------------------
# Stage 4: prod — self-contained, composer-optimized, assets baked in
# ---------------------------------------------------------------------------
FROM php-base AS prod

# Production PHP tuning on top of the base.
RUN { \
        echo "opcache.enable=1"; \
        echo "opcache.memory_consumption=192"; \
        echo "opcache.interned_strings_buffer=16"; \
        echo "opcache.max_accelerated_files=20000"; \
        echo "opcache.validate_timestamps=0"; \
        echo "opcache.preload_user=www-data"; \
        echo "expose_php=0"; \
    } > /usr/local/etc/php/conf.d/zz-prod.ini

# Composer install first (better layer caching).
COPY composer.json composer.lock ./
RUN composer install \
        --no-dev \
        --no-scripts \
        --no-autoloader \
        --prefer-dist \
        --no-interaction

# App source.
COPY . /var/www/html

# Built assets from node-builder stage.
COPY --from=node-builder /app/public/build /var/www/html/public/build

# Finish composer (runs package:discover etc. now that source is present).
RUN composer dump-autoload --optimize --classmap-authoritative \
    && composer run-script post-autoload-dump || true

# Cache framework files. These bake in env-independent state; runtime config
# (APP_URL, DB_*) is still read from .env via Laravel's env() at runtime
# unless config:cache is called again post-deploy. Keep view + route cache.
RUN php artisan view:cache \
    && php artisan route:cache

# Permissions baseline (entrypoint re-applies on container start in case
# of bind-mounted storage).
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# Snapshot the entire public/ tree so the entrypoint can refresh the shared
# nginx volume on every container start. Without this, the named volume
# silently keeps assets from the FIRST build forever.
RUN cp -a /var/www/html/public /opt/public-snapshot

EXPOSE 9000

HEALTHCHECK --interval=30s --timeout=5s --start-period=10s --retries=3 \
    CMD php-fpm -t || exit 1
