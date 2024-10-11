#!/bin/sh

# Start the Cloud SQL Proxy
/cloud_sql_proxy -dir=/cloudsql -instances=vocal-lamp-422222-s3:us-central1:bakers=tcp:3306 &

# Wait for the Cloud SQL Proxy to establish connection
sleep 10

# Run database migrations
php artisan migrate --force

# Start the Laravel queue worker
# php artisan queue:work --tries=3

# Start the Laravel application
exec php artisan serve --host=0.0.0.0 --port=8080

