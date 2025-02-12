# Dockerfile using Node.js base image
#FROM node:18-alpine

# Set working directory
#WORKDIR /usr/src/app

# Debug: Print working directory contents before copy
#RUN pwd && ls -la

# Copy package.json first
#COPY package.json ./

# Debug: Print contents after copy
#RUN ls -la

# Install dependencies
#RUN npm install

# Copy the rest of the application
#COPY . .

# Debug: Print final contents
#RUN ls -la

#EXPOSE 8181

#CMD [ "npm", "start" ]





#--- version two for deployment 

FROM php:7.4-apache

# Install MySQLi
RUN docker-php-ext-install mysqli

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy application files
COPY . /var/www/html/

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Configure Apache for our directory structure
RUN echo '<VirtualHost *:8181>\n\
    DocumentRoot /var/www/html\n\
    <Directory /var/www/html>\n\
        Options Indexes FollowSymLinks\n\
        AllowOverride All\n\
        Require all granted\n\
    </Directory>\n\
</VirtualHost>' > /etc/apache2/sites-available/000-default.conf

# Update Apache ports
RUN sed -i 's/Listen 80/Listen 8181/g' /etc/apache2/ports.conf

EXPOSE 8181
