FROM php:8.0-apache
RUN a2enmod rewrite
RUN apt-get update \ 
&& apt-get install -y --no-install-recommends git zlib1g-dev libzip-dev zip unzip libpng-dev
RUN docker-php-ext-install pdo pdo_mysql
RUN docker-php-ext-install mysqli
EXPOSE 80