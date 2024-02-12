FROM php:fpm

# install and setup custom extensions
RUN apt-get -qq -y update \
  && apt-get --no-install-recommends -qq -y install apt-transport-https \
  # mssql odbc driver
  && curl https://packages.microsoft.com/keys/microsoft.asc | apt-key add - \
  && curl https://packages.microsoft.com/config/debian/11/prod.list > /etc/apt/sources.list.d/mssql-release.list \
  && apt-get -qq -y update \
  && ACCEPT_EULA=Y apt-get install -y msodbcsql17 odbcinst=2.3.7 odbcinst1debian2=2.3.7 unixodbc-dev=2.3.7 unixodbc=2.3.7 \
  # install and enable extensions
  && pecl install pdo_sqlsrv-5.10.1 \
  && docker-php-ext-enable pdo_sqlsrv

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# RUN pecl install xdebug && docker-php-ext-enable xdebug