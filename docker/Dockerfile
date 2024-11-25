
FROM php:8.2-apache


RUN apt-get update && apt-get install -y \
    libonig-dev \
    libzip-dev \
    unzip \
    && docker-php-ext-install pdo_mysql mbstring zip


COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer


COPY docker/vhost.conf /etc/apache2/sites-available/000-default.conf


RUN a2enmod rewrite


WORKDIR /var/www/html


COPY . .


RUN composer install --optimize-autoloader --no-dev


RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache


RUN ln -s /var/www/html/.env /var/www/html/.env.local


EXPOSE 80
