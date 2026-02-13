FROM php:8.2-apache
# Instalamos la extensión PDO para MySQL
RUN docker-php-ext-install pdo pdo_mysql