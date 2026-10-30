# ---------- Etapa 1: compilar assets (Vite + Bootstrap) ----------
FROM node:22-alpine AS assets
WORKDIR /app
COPY package.json package-lock.json ./
RUN npm ci
COPY . .
RUN npm run build

# ---------- Etapa 2: PHP + Apache ----------
FROM php:8.4-apache

RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    libpq-dev \
    zip \
    unzip \
    git \
    curl \
    && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_pgsql pdo_mysql gd zip bcmath

ENV COMPOSER_ALLOW_SUPERUSER=1
RUN a2enmod rewrite

# DocumentRoot en /public y .htaccess permitido (necesario para las rutas de Laravel)
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
    && sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf \
    && printf '<Directory /var/www/html/public>\n    AllowOverride All\n    Require all granted\n</Directory>\n' > /etc/apache2/conf-available/laravel.conf \
    && a2enconf laravel

WORKDIR /var/www/html

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
COPY . .
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Assets compilados en la etapa 1
COPY --from=assets /app/public/build ./public/build

# Script de arranque (se limpian saltos de linea de Windows por si acaso)
RUN sed -i 's/\r$//' docker/start.sh && chmod +x docker/start.sh

RUN chown -R www-data:www-data storage bootstrap/cache

EXPOSE 10000
CMD ["./docker/start.sh"]
