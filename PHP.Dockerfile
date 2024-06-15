FROM php:fpm

# Install system dependencies for MySQL
RUN apt-get update && apt-get install -y \
    gnupg \
    unixodbc-dev \
    g++ \
    zlib1g-dev \
    libpng-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    git \
    && docker-php-ext-configure gd --enable-gd --with-freetype \
    && docker-php-ext-install gd pdo pdo_mysql mysqli \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN composer require mollie/mollie-api-php
RUN composer require phpmailer/phpmailer
RUN composer require mpdf/mpdf
RUN composer dump-autoload --optimize