FROM php:8.0-apache
RUN a2enmod rewrite
RUN apt-get update && apt-get install
RUN docker-php-ext-install pdo pdo_mysql
EXPOSE 80