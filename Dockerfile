# Use an official PHP runtime as a parent image
FROM php:8.2-apache

# Set the working directory to /var/www/html
WORKDIR /var/www/html

# Copy the current directory contents into the container at /var/www/html
COPY . /var/www/html

# Install any dependencies your PHP application needs
# For example, if using Composer, uncomment the following lines
RUN apt-get update && apt-get install -y \
    libpq-dev \
    git\
    nano \
    zip \
    unzip \
    curl

RUN rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pgsql pdo pdo_pgsql

RUN a2enmod rewrite

RUN service apache2 restart

 RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
 RUN composer install --no-interaction --no-dev --optimize-autoloader

# Make port 80 available to the world outside this container
EXPOSE 80

# Define environment variables, if necessary
# ENV VARIABLE_NAME=value

# Run apache when the container launches
CMD ["apache2-foreground"]