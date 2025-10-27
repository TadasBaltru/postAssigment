## Build vendor dependencies separately
FROM composer:2 AS vendor
WORKDIR /app
COPY composer.json composer.lock* ./
RUN composer install --no-dev --no-scripts --no-progress --prefer-dist || composer dump-autoload -o

## Runtime image
FROM php:8.3-apache

# Enable Apache modules and PHP extensions
RUN a2enmod rewrite \
	&& docker-php-ext-install mysqli pdo_mysql

WORKDIR /var/www/html

# Copy Composer binary from builder
COPY --from=vendor /usr/bin/composer /usr/bin/composer

# Copy source code
COPY . /var/www/html

# Configure Apache to serve /public as DocumentRoot
RUN printf '<VirtualHost *:80>\n\
    DocumentRoot /var/www/html/public\n\
    <Directory /var/www/html/public>\n\
        AllowOverride All\n\
        Require all granted\n\
        Options -Indexes -MultiViews +FollowSymLinks\n\
        DirectoryIndex index.php\n\
    </Directory>\n\
</VirtualHost>\n' > /etc/apache2/sites-available/000-default.conf

# Generate optimized autoload if possible (won't fail if no deps)
RUN composer dump-autoload -o || true

# Symlink assets into public if assets folder exists outside public
RUN [ -d "/var/www/html/assets" ] && ln -s /var/www/html/assets /var/www/html/public/assets || true

# Fix permissions
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80


