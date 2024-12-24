FROM wordpress:php8.0-apache

# Configura ServerName para evitar el mensaje de advertencia
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Instalar las extensiones de PHP necesarias (mysqli, pdo, pdo_mysql, etc.)
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libmysqlclient-dev \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd mysqli pdo pdo_mysql \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Exponer el puerto 80 de Apache
EXPOSE 80
