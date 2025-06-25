FROM php:8.2-apache

RUN a2enmod rewrite

# Set DocumentRoot to parent so both folders are accessible
RUN sed -i 's|DocumentRoot /var/www/html.*|DocumentRoot /var/www/html|' /etc/apache2/sites-available/000-default.conf

# Add Directory access for root
RUN echo '<Directory /var/www/html>\n\
    Options Indexes FollowSymLinks\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>' >> /etc/apache2/apache2.conf

# Add Alias to serve frontend at /
RUN echo 'Alias / /var/www/html/frontend/\n\
<Directory /var/www/html/frontend>\n\
    Options Indexes FollowSymLinks\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>' >> /etc/apache2/apache2.conf

COPY . /var/www/html/

# Permissions
RUN chown -R www-data:www-data /var/www/html && \
    find /var/www/html -type d -exec chmod 755 {} \; && \
    find /var/www/html -type f -exec chmod 644 {} \;

EXPOSE 80
