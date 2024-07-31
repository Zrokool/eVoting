
# Use the official PHP image as a base image
FROM php:8.1-apache

# Enable the PDO MySQL extension
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copy the Apache configuration file
COPY apache/000-default.conf /etc/apache2/sites-available/000-default.conf

# Copy the application files into the web server's root directory
COPY ../eVoting 2017/application/evoting/home.php

# Set permissions
RUN chown -R www-data:www-data /var/www/html/

# Expose port 80
EXPOSE 80
