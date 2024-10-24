# Utilizar la imagen base de PHP 8.2 con soporte FPM
FROM php:8.2-fpm

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y --no-install-recommends \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Instalar extensiones de PHP necesarias para Laravel
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo mbstring tokenizer xml gd

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Establecer directorio de trabajo
WORKDIR /var/www/html

# Copiar el archivo de Composer primero para optimizar el build si no cambian
COPY composer.json composer.lock ./

# Instalar dependencias de PHP sin interacción
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Copiar el contenido del proyecto al contenedor
COPY . .

# Establecer permisos correctos para las carpetas de Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Exponer el puerto 9000 para PHP-FPM
EXPOSE 9000

# Comando para iniciar el contenedor
CMD ["php-fpm"]
