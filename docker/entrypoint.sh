#!/bin/sh
set -e

# Generate app key if missing
if [ -z "$APP_KEY" ]; then
    if ! grep -q "^APP_KEY=base64:" /var/www/html/.env 2>/dev/null; then
        echo "Generating application key..."
        php artisan key:generate --force || true
    fi
fi

# Ensure storage link exists
php artisan storage:link || true

# Optimize configuration and routes caching in production if flag or env set
if [ "$APP_ENV" = "production" ]; then
    echo "Caching configuration and routes..."
    php artisan config:cache || true
    php artisan route:cache || true
    php artisan view:cache || true
fi

# Fix permissions for storage and bootstrap/cache
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Execute CMD (starts supervisord)
exec "$@"
