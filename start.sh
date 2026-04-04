#!/bin/bash

# Create SQLite database if it doesn't exist
touch database/database.sqlite

# Copy env example if .env doesn't exist
if [ ! -f .env ]; then
    cp .env.example .env
    php artisan key:generate
fi

# Set proper database connection
sed -i 's/DB_CONNECTION=mysql/DB_CONNECTION=sqlite/' .env
sed -i 's/DB_DATABASE=.*/DB_DATABASE=\/app\/database\/database.sqlite/' .env

# Run migrations and seeding
echo "Running migrations..."
php artisan migrate:fresh --seed --force

# Create storage links
php artisan storage:link

# Start the server on port 7860 (Hugging Face default)
echo "Starting Laravel server..."
php artisan serve --host=0.0.0.0 --port=7860
