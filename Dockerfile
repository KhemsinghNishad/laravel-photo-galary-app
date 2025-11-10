FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    git unzip libzip-dev \
    && docker-php-ext-install pdo pdo_mysql zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . .

RUN composer install --no-dev --optimize-autoloader

CMD php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=10000
