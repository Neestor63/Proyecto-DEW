FROM php:8.2-apache

# Instalamos las extensiones de MySQL
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Forzamos a Apache a mirar en /var/www/html y permitimos el acceso
RUN sed -i 's|/var/www/html|/var/www/html|g' /etc/apache2/sites-available/000-default.conf
RUN echo "<Directory /var/www/html>\n\tOptions Indexes FollowSymLinks\n\tAllowOverride All\n\tRequire all granted\n</Directory>" >> /etc/apache2/apache2.conf

# Ajustamos permisos
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html