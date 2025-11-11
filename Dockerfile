FROM php:8.2-fpm

# System dependencies
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libpq-dev libicu-dev \
    libpng-dev libjpeg62-turbo-dev libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_pgsql zip intl gd \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

# install deps using cached layer
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

# app files
COPY . .

# permissions
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Expose port
EXPOSE 10000

# use Render's $PORT if provided; do NOT run migrations automatically here
CMD ["sh", "-lc", "php artisan serve --host=0.0.0.0 --port=${PORT:-10000}"]
