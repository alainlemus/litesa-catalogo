FROM php:8.4-apache

# ================================
# Dependencias del sistema (FIXED)
# ================================
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    libicu-dev \
    zip \
    unzip \
    git \
    curl \
    gnupg \
    ca-certificates \
    && rm -rf /var/lib/apt/lists/*

# ================================
# Instalar Node (forma estable)
# ================================
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get update && apt-get install -y nodejs

# ================================
# Extensiones PHP
# ================================
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
        gd \
        zip \
        pdo_mysql \
        intl \
        mbstring \
        bcmath \
        exif \
        pcntl

# Apache
RUN a2enmod rewrite

# Composer
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN cp .env.example .env || true

RUN composer install --no-interaction --prefer-dist --optimize-autoloader

RUN if [ -f package.json ]; then npm install && npm run build; fi

RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

EXPOSE 80

CMD php artisan storage:link || true && apache2-foreground
