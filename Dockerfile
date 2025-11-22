FROM php:8.2-apache

# 1. Install development packages and clean up apt cache
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
    libzip-dev \
 && apt-get clean && rm -rf /var/lib/apt/lists/*

# 2. Install PHP extensions required by Laravel
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# 3. Enable Apache mod_rewrite for Laravel URLs
RUN a2enmod rewrite

# 4. Configure Apache DocumentRoot to point to public folder
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf

# -------------------------------------------------------------------
# ⚠️ CRITICAL FIX FOR 404 ERRORS: Enable .htaccess Overrides
# -------------------------------------------------------------------
RUN echo '<Directory /var/www/html/public/>' >> /etc/apache2/apache2.conf && \
    echo '    Options Indexes FollowSymLinks' >> /etc/apache2/apache2.conf && \
    echo '    AllowOverride All' >> /etc/apache2/apache2.conf && \
    echo '    Require all granted' >> /etc/apache2/apache2.conf && \
    echo '</Directory>' >> /etc/apache2/apache2.conf
# -------------------------------------------------------------------

# 5. Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 6. Set working directory
WORKDIR /var/www/html

# 7. Copy application files
COPY . /var/www/html

# 8. Install dependencies
RUN composer install --no-dev --optimize-autoloader

# 9. Set permissions for Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# 10. Expose port 80
EXPOSE 80

# 11. Start Command (Runs every time the server boots)
# This links the storage, runs DB migrations, and then starts Apache
CMD bash -c "php artisan storage:link && php artisan config:cache && apache2-foreground"