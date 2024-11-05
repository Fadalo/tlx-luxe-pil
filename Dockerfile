# Dockerfile

# Use the official PHP 8.2 image with Apache 
FROM php:8.2-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    zip \
    unzip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    curl

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Enable Apache rewrite module (useful for frameworks like Laravel)
RUN a2enmod rewrite

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set the working directory
WORKDIR /var/www/html

   
# Copy the application files to the container
COPY . /var/www/html

# Set permissions (adjust for your environment as needed)
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache

# Set permissions (optional, but useful for some frameworks)

RUN cd /var/www/html

# Copy and set environment variables
ENV DB_CONNECTION=mysql \
    DB_HOST=luxe-mysql \
    DB_PORT=3306 \
    DB_DATABASE=em_db \
    DB_USERNAME=em-user \
    DB_PASSWORD=secret \
    WA_API=http://127.0.0.1:3000/api

    
# Install dependencies
RUN composer install --no-scripts --no-autoloader 

# Generate autoload files
RUN composer dump-autoload    


# Expose port 80 to allow access to the web server
EXPOSE 80 443 8000

ENV APACHE_DOCUMENT_ROOT /var/www/html/public


# Update the Apache configuration to use the new DocumentRoot
RUN sed -ri -e "s|DocumentRoot /var/www/html|DocumentRoot ${APACHE_DOCUMENT_ROOT}|g" /etc/apache2/sites-available/000-default.conf \
    && sed -ri -e "s|<Directory /var/www/html>|<Directory ${APACHE_DOCUMENT_ROOT}>|g" /etc/apache2/apache2.conf

#CMD php artisan serve --host=0.0.0.0 --port=8000 &&
#CMD ["apache2-foreground"]

COPY docker-entrypoint.sh /usr/local/bin/
COPY docker-waitdb.sh /usr/local/bin/

RUN chmod +x /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-waitdb.sh
RUN apt install netcat-openbsd
#RUN apt install exec

CMD ["docker-entrypoint.sh"]
