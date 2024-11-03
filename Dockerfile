# Use the official PHP image as a parent image
FROM php:8.2-fpm

# Set the working directory in the container
WORKDIR /var/www

# Copy the composer.lock and composer.json files first to leverage cached layers
COPY composer.lock composer.json ./

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    unzip \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd zip pdo pdo_mysql

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy the rest of the application files
COPY . .

# Install application dependencies
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Set permissions for storage and bootstrap/cache directories
RUN chown -R www-data:www-data storage bootstrap/cache

# Expose port 9000 to the outside world
EXPOSE 9000

# Start PHP-FPM server
CMD ["php-fpm"]
