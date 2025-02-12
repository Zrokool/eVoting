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


# Use PHP with Apache
FROM php:7.4-apache

# Install any PHP extensions you might need
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set the working directory in container
WORKDIR /var/www/html

# Copy the application files
COPY . /var/www/html/

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Apache config to handle subdirectories
RUN echo '<Directory /var/www/html>\n\
    Options Indexes FollowSymLinks\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>' > /etc/apache2/conf-available/custom.conf \
    && a2enconf custom

# Expose port 8181
EXPOSE 8181

# Update the default apache site to use port 8181
RUN sed -i 's/80/8181/g' /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf
