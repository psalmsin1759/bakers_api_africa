# Use an official PHP runtime as a parent image
FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    libjpeg-dev \
    libpng-dev \
    libwebp-dev \
    libfreetype6-dev \
    librdkafka-dev \
    && docker-php-ext-install pdo pdo_mysql \
    && docker-php-ext-configure gd --with-jpeg --with-webp --with-freetype \
    && docker-php-ext-install gd \
    && pecl install rdkafka \
    && docker-php-ext-enable rdkafka \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /var/www/html

# Copy composer files and install Laravel dependencies
COPY composer.json composer.lock ./
RUN composer install --no-scripts --no-autoloader

# Copy application files
COPY . .

# Generate autoload files
RUN composer dump-autoload --optimize

# Install Cloud SQL Proxy
COPY --from=gcr.io/cloudsql-docker/gce-proxy:1.19.1 /cloud_sql_proxy /cloud_sql_proxy

# Copy entrypoint script
COPY entrypoint.sh /usr/local/bin/

# Ensure the entrypoint script is executable
RUN chmod +x /usr/local/bin/entrypoint.sh

# Expose port
EXPOSE 8080

# CMD ["php", "artisan", "queue:work"]


# Set entrypoint
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
