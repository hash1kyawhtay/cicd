FROM php:8.2-apache

# Copy your PHP app to container
COPY . /var/www/html/

# (Optional) Enable Apache mod_rewrite, extensions etc.
RUN docker-php-ext-install mysqli pdo pdo_mysql
