FROM php:8.3-apache

WORKDIR /var/www/html

# نصب ابزارهای لازم
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libzip-dev \
    nodejs \
    npm \
    && docker-php-ext-install pdo_sqlite zip

# نصب Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# کپی پروژه
COPY . .

# نصب پکیج‌های PHP
RUN composer install --no-dev --optimize-autoloader

# نصب و Build فرانت‌اند
RUN npm install && npm run build

# ساخت storage link
RUN php artisan storage:link || true

# دسترسی پوشه‌ها
RUN chown -R www-data:www-data storage bootstrap/cache

EXPOSE 80

CMD ["apache2-foreground"]