# Use the official PHP image with Apache
FROM php:8.1-apache

# Install dependencies
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

# Copy custom Apache configuration file
COPY apache.conf /etc/apache2/sites-available/000-default.conf

# Enable Apache's rewrite module (if needed for routing)
RUN a2enmod rewrite

# Set the working directory to the web root
WORKDIR /var/www/html

# Copy your project files into the container
COPY . /var/www/html/

# Adjust permissions (ensure Apache can write where necessary)
RUN chown -R www-data:www-data /var/www/html/

# Expose port 80 to be accessible externally
EXPOSE 80

# Start Apache in the foreground
CMD ["apache2-foreground"]
