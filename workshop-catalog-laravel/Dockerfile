# syntax=docker/dockerfile:1

# ── Stage 1: build degli asset Vite (le pagine Blade di Breeze usano @vite) ──
FROM node:20-slim AS assets
WORKDIR /app
COPY package.json package-lock.json ./
RUN npm ci
COPY . .
RUN npm run build

# ── Stage 2: runtime PHP ──
FROM php:8.2-cli AS app

RUN apt-get update && apt-get install -y --no-install-recommends \
        libsqlite3-dev libonig-dev libzip-dev unzip \
    && docker-php-ext-install pdo_sqlite mbstring bcmath zip \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Prima solo i file di dipendenza → cache del layer composer
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-progress --no-scripts

COPY . .
COPY --from=assets /app/public/build ./public/build

RUN composer dump-autoload --optimize --no-dev --no-scripts

ENV PORT=8080
EXPOSE 8080

# A ogni avvio: discover pacchetti, cache config (legge le env di Railway),
# migrazioni sul volume, symlink storage, poi il server.
CMD php artisan package:discover --ansi \
 && php artisan config:cache \
 && php artisan migrate --force \
 && php artisan storage:link --force \
 && php artisan serve --host 0.0.0.0 --port "${PORT}"
