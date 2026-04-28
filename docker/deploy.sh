#!/bin/bash
set -e

echo "🚀 Starting deployment..."

# Create SQLite database if it doesn't exist
touch /var/www/html/database/database.sqlite
chown -R www-data:www-data /var/www/html/database
chmod -R 775 /var/www/html/database

# Ensure log directory exists
mkdir -p /var/www/html/storage/logs
chown -R www-data:www-data /var/www/html/storage/logs

# Run migrations
php artisan migrate --force --no-interaction

# Seed database (only if tables are empty)
php artisan db:seed --force --no-interaction 2>/dev/null || true

# Cache config, routes, and views for performance
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Create storage symlink
php artisan storage:link 2>/dev/null || true

# Ensure all storage paths are writable by www-data
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

echo "✅ Deployment complete. Starting services..."

# Start Supervisor (manages PHP-FPM + Nginx)
exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
