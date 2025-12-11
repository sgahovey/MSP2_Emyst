FROM dunglas/frankenphp:latest

ENV COMPOSER_ALLOW_SUPERUSER=1
ENV APP_ENV=prod
ENV APP_DEBUG=0

# Dépendances système
RUN apt-get update && apt-get install -y \
    git curl libpng-dev libonig-dev libxml2-dev zip unzip libzip-dev libicu-dev \
    && rm -rf /var/lib/apt/lists/*

# Extensions PHP
RUN install-php-extensions \
    pdo_mysql pdo intl opcache zip gd mbstring exif bcmath

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Copier tout le projet
COPY . .

# Copier le Caddyfile
COPY Caddyfile /etc/caddy/Caddyfile

# Installer les dépendances
RUN composer install --no-dev --no-interaction --optimize-autoloader --prefer-dist

# Optimiser l'autoload sans warmup
RUN composer dump-autoload --optimize --classmap-authoritative

# Créer les dossiers var/*
RUN mkdir -p var/cache var/log var/sessions \
 && chown -R www-data:www-data var \
 && chmod -R 775 var

# OPcache pour la prod
RUN echo "opcache.enable=1" > /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.memory_consumption=256" >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.interned_strings_buffer=16" >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.max_accelerated_files=20000" >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.validate_timestamps=0" >> /usr/local/etc/php/conf.d/opcache.ini

EXPOSE 8080

CMD ["frankenphp", "run"]
