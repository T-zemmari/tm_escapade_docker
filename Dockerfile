# Descargar la imagen oficial de PHP con Apache
FROM php:8-apache

# Instala las dependencias necesarias
RUN apt-get update \
    && apt-get install -y \
        libzip-dev \
        zlib1g-dev \
        libpq-dev \
        libjpeg-dev \
        libpng-dev \
        libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd zip pdo_mysql mysqli \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Habilita el módulo mod_rewrite de Apache
RUN a2enmod rewrite

# Instala la biblioteca dotenv
RUN apt-get update \
    && apt-get install -y \
        unzip \
    && rm -rf /var/lib/apt/lists/*

# Instala Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copia los archivos de la aplicación al directorio de trabajo del contenedor
COPY . /var/www/html

# Copia el archivo .env al directorio de trabajo del contenedor
COPY .env /var/www/html

# Copia el archivo .htaccess al directorio de trabajo del contenedor
COPY .htaccess /var/www/html/

# Establece los permisos adecuados en el directorio de trabajo
RUN chown -R www-data:www-data /var/www/html

# Añadir comando para crear directorio de persistencia de datos para MySQL
RUN mkdir -p /var/lib/mysql

# Exponer el puerto 80
EXPOSE 80

# Reiniciar Apache al iniciar el contenedor
CMD ["apachectl", "-D", "FOREGROUND"]

# Ajusta la configuración de PHP para aumentar el tamaño máximo del cuerpo de las solicitudes POST
RUN echo "post_max_size = 100M" > /usr/local/etc/php/conf.d/custom.ini