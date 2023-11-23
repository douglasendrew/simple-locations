FROM php:8.2-fpm

RUN apt-get update && \
    apt-get install -y \
        git \
        zip \
        unzip \
        libzip-dev \
    && docker-php-ext-install pdo_mysql zip

COPY . /var/www/html

WORKDIR /var/www/html

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 456

CMD ["php-fpm"]
