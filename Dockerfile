FROM dunglas/frankenphp:php8.2-bookworm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install PHP extensions (IMPORTANT: tambahkan pdo_mysql)
RUN install-php-extensions intl zip ctype curl dom fileinfo filter hash mbstring openssl pcre pdo pdo_mysql session tokenizer xml

# Install Node.js
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

# Set working directory
WORKDIR /app

# Copy composer files
COPY composer.json composer.lock ./

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Copy package files
COPY package*.json ./

# Install Node dependencies
RUN npm ci

# Copy application files
COPY . .

# Build frontend assets
RUN npm run build

# Set permissions
RUN mkdir -p storage/framework/{sessions,views,cache,testing} storage/logs bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Create entrypoint script
COPY <<'EOF' /entrypoint.sh
#!/bin/bash
set -e

echo "Waiting for database connection..."
sleep 5

echo "Running migrations..."
php artisan migrate --force || echo "Migration failed, continuing..."

echo "Clearing cache..."
php artisan config:clear
php artisan cache:clear
php artisan view:clear

echo "Starting server on port $PORT..."
php artisan serve --host=0.0.0.0 --port=$PORT
EOF

RUN chmod +x /entrypoint.sh

# Expose port
EXPOSE 8000

# Start application
ENTRYPOINT ["/entrypoint.sh"]