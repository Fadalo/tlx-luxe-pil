#!/bin/bash
set -e

# Wait until MySQL is ready
until nc -z -v -w30 $DB_HOST $DB_PORT; do
    echo "Waiting for database connection at $DB_HOST:$DB_PORT..."
    sleep 10
done

echo "Database is up - running migrations and seeding"
php artisan db:wipe
php artisan migrate --force
php artisan db:seed --force


apache2-foreground
