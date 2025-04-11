FROM php:8.2-alpine AS builder

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    supervisor \
    nginx \
    build-essential \
    openssl

RUN docker-php-ext-install \
    pdo_mysql \
    gd \
    zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html
COPY . .

COPY .env.example /var/www/html/.env

RUN composer install --no-dev --optimize-autoloader --no-interaction


RUN cd /var/www/html && \
    php artisan key:generate

RUN cd /var/www/html && \
    php artisan migrate --force && \
    php artisan db:seed --force && \ php artisan storage:link


FROM nginx:alpine

COPY docker/nginx/nginx.conf /etc/nginx/nginx.conf
COPY docker/nginx/site.conf /etc/nginx/conf.d/default.conf

COPY --from=builder /var/www/html /var/www/html
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache

EXPOSE 3400
CMD ["nginx", "-g", "daemon off;"]
