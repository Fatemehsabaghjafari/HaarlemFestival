FROM php:fpm

# Install system dependencies for SQL Server pdo_sqlsrv and sqlsrv
RUN apt-get update && apt-get install -y \
        gnupg \
        unixodbc-dev \
        g++ \
        && docker-php-ext-install pdo pdo_mysql mysqli

# Add Microsoft's official repository
RUN curl https://packages.microsoft.com/keys/microsoft.asc | apt-key add - \
    && curl https://packages.microsoft.com/config/ubuntu/20.04/prod.list > /etc/apt/sources.list.d/mssql-release.list

# Install SQL Server drivers and necessary tools
RUN apt-get update && ACCEPT_EULA=Y apt-get install -y \
        msodbcsql18 \
        mssql-tools18 \
        unixodbc \
    && pecl install pdo_sqlsrv sqlsrv \
    && docker-php-ext-enable pdo_sqlsrv sqlsrv \
    && apt-get clean && rm -rf /var/lib/apt/lists/*