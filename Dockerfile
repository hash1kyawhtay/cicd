FROM php:8.2-apache

RUN a2enmod rewrite

RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

RUN echo "<Directory /var/www/html/frontend>\n\
    Options Indexes FollowSymLinks\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>" >> /etc/apache2/apache2.conf

# Change DocumentRoot to frontend
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/frontend|' /etc/apache2/sites-available/000-default.conf

RUN sed -i 's|<Directory /var/www/html>|<Directory /var/www/html/frontend>|' /etc/apache2/apache2.conf

COPY . /var/www/html/

RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

EXPOSE 80

