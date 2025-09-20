FROM php:8.2-cli

# Dependências básicas
RUN apt-get update && apt-get install -y \
    unzip git curl libpng-dev libonig-dev libxml2-dev zip \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Composer
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Instalar dependências Laravel
RUN composer global require laravel/installer

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
