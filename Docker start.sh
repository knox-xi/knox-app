set -e
mkdir -p storage/framework/cache storage/framework/sessions storage/framework/views storage/logs bootstrap/cache
touch database/database.sqlite
if [ -z "$APP_KEY" ]; then
  export APP_KEY=$(php artisan key:generate --show)
fi
php artisan migrate --force
php artisan serve --host=0.0.0.0 --port=${PORT:-10000}
