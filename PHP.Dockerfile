FROM php:fpm

RUN apt-get update && \
    apt-get install -y \
    unixODBC-dev

# Install pdo_sqlsrv extension
RUN pecl install pdo_sqlsrv && \
    docker-php-ext-enable pdo_sqlsrv
    
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# RUN pecl install xdebug && docker-php-ext-enable xdebug