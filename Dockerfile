# === PHP-FPM 8.3 (Alpine) con extensiones comunes y Node ===
FROM php:8.3-fpm-alpine

ARG WWWUSER=1000
ARG WWWGROUP=1000

# Paquetes de runtime + node
RUN set -eux; \
    apk add --no-cache \
      git curl zip unzip bash shadow openssl \
      icu icu-dev libxml2-dev oniguruma-dev \
      libpng-dev freetype-dev libjpeg-turbo-dev \
      libzip-dev linux-headers \
      nodejs npm \
    ; \
    apk add --no-cache --virtual .build-deps $PHPIZE_DEPS; \
    docker-php-ext-configure gd --with-freetype --with-jpeg; \
    docker-php-ext-install -j"$(nproc)" \
      pdo pdo_mysql mbstring exif pcntl bcmath intl gd zip; \
    pecl install redis; \
    docker-php-ext-enable redis; \
    apk del .build-deps

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Usuario no root
RUN usermod -u ${WWWUSER} www-data && groupmod -g ${WWWGROUP} www-data

# Crear directorios y dar permisos
RUN mkdir -p /var/www/html /home/www-data/.npm && \
    chown -R www-data:www-data /var/www/html /home/www-data/.npm

WORKDIR /var/www/html

# Copiar TODO el proyecto **antes de instalar dependencias**
COPY --chown=www-data:www-data . .

# Asegurarse que www-data puede escribir en node_modules y vendor
RUN mkdir -p /var/www/html/vendor /var/www/html/node_modules && \
    chown -R www-data:www-data /var/www/html/vendor /var/www/html/node_modules

USER www-data

# Instalar dependencias PHP y Node
RUN composer install --no-interaction
RUN npm install

# Instalar sass-embedded local (dev dependency para Vite)
RUN npm install --save-dev sass-embedded
