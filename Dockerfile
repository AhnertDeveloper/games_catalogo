FROM php:7.2-fpm

# Instala extensões necessárias
RUN sed -i 's/deb.debian.org/archive.debian.org/g' /etc/apt/sources.list \
 && sed -i '/security.debian.org/d' /etc/apt/sources.list \
 && apt-get update \
 && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    curl \
    libpq-dev \
 && docker-php-ext-install pdo pdo_mysql pdo_pgsql gd

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/laravel

# Copia os arquivos do projeto Laravel para dentro do container
COPY laravel/. .

# Instala dependências do Composer
RUN composer install

# Permissões
RUN chown -R www-data:www-data /var/www
