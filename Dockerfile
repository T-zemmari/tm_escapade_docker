# Descargar la imagen oficial de PHP con Apache
FROM php:8-apache

# Instala las dependencias necesarias
RUN apt-get update \
    && apt-get install -y \
        libzip-dev \
    && docker-php-ext-install -j$(nproc) zip pdo_mysql \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Instala la biblioteca dotenv
RUN apt-get update \
    && apt-get install -y \
        unzip \
    && rm -rf /var/lib/apt/lists/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copia los archivos de la aplicación al directorio de trabajo del contenedor
COPY . /var/www/html

# Instala las dependencias de Composer
RUN composer install --no-dev

# Copia el archivo .env al directorio de trabajo del contenedor
COPY .env /var/www/html

# Establece los permisos adecuados en el directorio de trabajo
RUN chown -R www-data:www-data /var/www/html

# Añadir comando para crear directorio de persistencia de datos para MySQL
RUN mkdir -p /var/lib/mysql

# Exponer el puerto 80
EXPOSE 80

# Iniciar Apache en primer plano al ejecutar el contenedor
CMD ["apache2-foreground"]
