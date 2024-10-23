# Use the official Drupal 10 Docker image as a base
FROM drupal:10-apache

# Change the Apache port to 8686
RUN sed -i 's/80/8686/g' /etc/apache2/ports.conf /etc/apache2/sites-available/000-default.conf

# Install additional PHP extensions if necessary
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

# Copy the current directory content into the Drupal container's web root
COPY . /var/www/html

# Set the appropriate permissions for the files directory
RUN chown -R www-data:www-data /var/www/html

# Expose port 8686
EXPOSE 8686
