# === PHP-FPM 8.3 (Alpine) con extensiones comunes y Node ===
FROM php:8.3-fpm-alpine

ARG WWWUSER=1000
ARG WWWGROUP=1000

# Instalar PHP, extensiones y Node
RUN set -eux; \
    apk add --no-cache \
      git curl zip unzip bash shadow icu icu-dev libxml2-dev oniguruma-dev \
      libpng-dev freetype-dev libjpeg-turbo-dev libzip-dev linux-headers \
      nodejs npm; \
    apk add --no-cache --virtual .build-deps $PHPIZE_DEPS; \
    docker-php-ext-configure gd --with-freetype --with-jpeg; \
    docker-php-ext-install -j"$(nproc)" pdo pdo_mysql mbstring exif pcntl bcmath intl gd zip; \
    pecl install redis; \
    docker-php-ext-enable redis; \
    apk del .build-deps

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Crear usuario no root
RUN usermod -u ${WWWUSER} www-data && groupmod -g ${WWWGROUP} www-data

# Directorios y permisos
RUN mkdir -p /var/www/html /home/www-data/.npm && \
    chown -R www-data:www-data /var/www/html /home/www-data/.npm

WORKDIR /var/www/html

# No copiamos el proyecto ni instalamos dependencias aún
# Esto lo hará Makefile después de que los archivos existan

USER www-data
