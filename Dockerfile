# Dockerfile
FROM php:7.4-apache

# Install MySQLi extension
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Enable Apache modules
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy application files
COPY ./application/evoting /var/www/html/evoting/

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Configure Apache VirtualHost
RUN echo '<VirtualHost *:8181>\n\
    ServerAdmin webmaster@localhost\n\
    DocumentRoot /var/www/html\n\
    \n\
    <Directory /var/www/html>\n\
        Options Indexes FollowSymLinks\n\
        AllowOverride All\n\
        Require all granted\n\
    </Directory>\n\
    \n\
    <Directory /var/www/html/evoting>\n\
        Options Indexes FollowSymLinks\n\
        AllowOverride All\n\
        Require all granted\n\
    </Directory>\n\
    \n\
    ErrorLog ${APACHE_LOG_DIR}/error.log\n\
    CustomLog ${APACHE_LOG_DIR}/access.log combined\n\
</VirtualHost>' > /etc/apache2/sites-available/000-default.conf

# Update Apache to listen on port 8181
RUN sed -i 's/Listen 80/Listen 8181/g' /etc/apache2/ports.conf

# Enable PHP error display (for educational/debugging purposes)
RUN echo "display_errors = On" >> /usr/local/etc/php/conf.d/display-errors.ini \
    && echo "error_reporting = E_ALL" >> /usr/local/etc/php/conf.d/display-errors.ini

EXPOSE 8181

CMD ["apache2-foreground"]
