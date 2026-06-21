FROM php:8.3-apache

WORKDIR /var/www/html

# نصب وابستگی‌های سیستم و PHP Extension ها
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libzip-dev \
    libsqlite3-dev \
    nodejs \
    npm \
    && docker-php-ext-install pdo_sqlite zip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# نصب Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# کپی کردن پروژه
COPY . .

# نصب پکیج‌های PHP
RUN composer install \
    --no-dev \
    --optimize-autoloader \
    --no-interaction

# نصب و Build فایل‌های Vite
RUN npm install
RUN npm run build

# فعال کردن Rewrite برای Laravel
RUN a2enmod rewrite

# تنظیم Document Root آپاچی روی public لاراول
RUN sed -ri -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/*.conf \
    && sed -ri -e 's!/var/www/!/var/www/!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# ساخت لینک Storage
RUN php artisan storage:link || true

# دسترسی پوشه‌های لاراول و فایل SQLite
RUN chown -R www-data:www-data \
    storage \
    bootstrap/cache \
    database

RUN chmod -R 775 \
    storage \
    bootstrap/cache \
    database

# پاک کردن کش‌های لاراول
RUN php artisan config:clear || true
RUN php artisan cache:clear || true
RUN php artisan route:clear || true
RUN php artisan view:clear || true

EXPOSE 80

CMD ["apache2-foreground"]