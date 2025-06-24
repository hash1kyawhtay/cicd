FROM php:8.2-apache

RUN a2enmod rewrite
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Suppress ServerName warning
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

COPY . /var/www/html/

EXPOSE 80
