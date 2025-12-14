# Dockerfile pour Symfony 8 + API Platform + FrankenPHP
# Image de base avec FrankenPHP et PHP 8.4
FROM dunglas/frankenphp:latest

# Variables d'environnement (seront surchargées par Railway)
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
RUN if [ -f /app/Caddyfile ]; then cp /app/Caddyfile /etc/caddy/Caddyfile; fi

# Création des dossiers nécessaires avec les bons droits
RUN mkdir -p /app/var/cache /app/var/log /app/var/sessions \
    && chown -R www-data:www-data /app/var \
    && chmod -R 755 /app/var

# Optimisation de l'autoloader (sans cache:warmup qui nécessite les variables d'env)
RUN composer dump-autoload --optimize --classmap-authoritative --no-dev

# Configuration OPcache pour la production
RUN echo "opcache.enable=1" > /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.memory_consumption=256" >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.interned_strings_buffer=16" >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.max_accelerated_files=20000" >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.validate_timestamps=0" >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.revalidate_freq=0" >> /usr/local/etc/php/conf.d/opcache.ini

# Création du script d'entrée pour vider le cache au démarrage
RUN echo '#!/bin/sh\n\
set -e\n\
# Supprimer manuellement le cache pour éviter les erreurs avec l\'ancienne configuration\n\
rm -rf /app/var/cache/prod/* || true\n\
# Vider le cache au démarrage pour régénérer avec les vraies variables d\'environnement\n\
# Utiliser APP_ENV=prod explicitement pour éviter de charger .env\n\
APP_ENV=prod php bin/console cache:clear --env=prod --no-debug --no-interaction || true\n\
# Démarrer FrankenPHP\n\
exec frankenphp run' > /usr/local/bin/docker-entrypoint.sh \
    && chmod +x /usr/local/bin/docker-entrypoint.sh

# Exposition du port 8080 (port standard pour FrankenPHP sur Railway)
EXPOSE 8080

# Commande pour démarrer via le script d'entrée
CMD ["/usr/local/bin/docker-entrypoint.sh"]

