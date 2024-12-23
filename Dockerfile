# Use the official PHP 8.3 image with FPM
FROM php:8.3-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libonig-dev \
    libzip-dev \
    zip \
    unzip \
    libcurl4-openssl-dev \
    pkg-config \
    libssl-dev

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql zip

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /var/www/html

# Copy project files (except those ignored in .dockerignore)
COPY . /var/www/html

# Install project dependencies
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Expose port 8000 and use Laravel's built-in dev server
EXPOSE 8000
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
