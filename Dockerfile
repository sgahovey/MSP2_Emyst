# Dockerfile pour Symfony 8 + API Platform + FrankenPHP
# Image de base avec FrankenPHP et PHP 8.4
FROM dunglas/frankenphp:latest

# Variables d'environnement
ENV COMPOSER_ALLOW_SUPERUSER=1
ENV APP_ENV=prod
ENV APP_DEBUG=0

# Installation des dépendances système nécessaires
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    libicu-dev \
    && rm -rf /var/lib/apt/lists/*

# Installation des extensions PHP requises avec install-php-extensions
# Cette méthode est plus fiable que docker-php-ext-install
RUN install-php-extensions \
    pdo_mysql \
    pdo \
    intl \
    opcache \
    zip \
    gd \
    mbstring \
    exif \
    bcmath

# Copie de Composer depuis l'image officielle
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Définition du répertoire de travail
WORKDIR /app

# Copie des fichiers de configuration Composer et Symfony
COPY composer.json composer.lock symfony.lock ./

# Installation des dépendances Composer (production uniquement)
# On utilise --no-scripts pour éviter d'exécuter les scripts avant d'avoir tout copié
RUN composer install --no-dev --no-interaction --no-scripts --optimize-autoloader --prefer-dist

# Copie du reste du projet
COPY . .

# Copie du Caddyfile vers l'emplacement attendu par FrankenPHP
# FrankenPHP cherche le Caddyfile dans /etc/caddy/Caddyfile
RUN if [ -f /app/Caddyfile ]; then cp /app/Caddyfile /etc/caddy/Caddyfile; fi

# Exécution des scripts post-installation et optimisation de l'autoloader
RUN composer dump-autoload --optimize --classmap-authoritative --no-dev \
    && php bin/console cache:warmup --env=prod --no-debug || true

# Création des dossiers nécessaires avec les bons droits
# Ces dossiers seront créés par cache:clear, mais on s'assure qu'ils existent
RUN mkdir -p /app/var/cache /app/var/log /app/var/sessions \
    && chown -R www-data:www-data /app/var \
    && chmod -R 755 /app/var

# Configuration OPcache pour la production
RUN echo "opcache.enable=1" > /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.memory_consumption=256" >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.interned_strings_buffer=16" >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.max_accelerated_files=20000" >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.validate_timestamps=0" >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.revalidate_freq=0" >> /usr/local/etc/php/conf.d/opcache.ini

# Exposition du port 8080 (port standard pour FrankenPHP)
EXPOSE 8080

# Commande pour démarrer FrankenPHP
# FrankenPHP utilise automatiquement le Caddyfile dans /etc/caddy/Caddyfile
# Le Caddyfile définit le document root vers /app/public et le port 8080
CMD ["frankenphp", "run"]

