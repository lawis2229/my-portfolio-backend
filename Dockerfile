FROM php:8.3-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    curl \
    && docker-php-ext-install pdo_mysql mbstring exif bcmath gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

# Install dependencies (production only)
RUN composer install --no-dev --optimize-autoloader

# Permissions
RUN chmod -R 777 storage bootstrap/cache

# Optimize Laravel (VERY IMPORTANT)
RUN php artisan key:generate --force || true
RUN php artisan config:clear
RUN php artisan optimize

EXPOSE 10000

# Run migrations then serve
CMD sh -c "\
php artisan migrate --force || true && \
php artisan serve --host=0.0.0.0 --port=10000 \
"
