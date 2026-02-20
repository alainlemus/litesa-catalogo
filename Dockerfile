# Imagen base
FROM php:8.4-apache

# ================================
# Dependencias del sistema + Node
# ================================
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    curl \
    libicu-dev \
    nodejs \
    npm \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
        gd \
        zip \
        pdo_mysql \
        intl \
        mbstring \
        bcmath \
        exif \
        pcntl

# ================================
# Apache
# ================================
RUN a2enmod rewrite

# ================================
# Composer
# ================================
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

# ================================
# Working directory
# ================================
WORKDIR /var/www/html

# ================================
# Copiar proyecto
# ================================
COPY . .

# ================================
# Crear .env si no existe
# ================================
RUN cp .env.example .env || true

# ================================
# Instalar dependencias PHP
# ================================
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# ================================
# Build frontend (solo si hay Vite)
# ================================
RUN if [ -f package.json ]; then npm install && npm run build; fi

# ================================
# Permisos Laravel
# ================================
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# ================================
# Puerto
# ================================
EXPOSE 80

# ================================
# Startup (IMPORTANTE para Filament)
# ================================
CMD php artisan storage:link || true && apache2-foreground
