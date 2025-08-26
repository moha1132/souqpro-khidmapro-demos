
#!/usr/bin/env sh
set -e
php -v
mkdir -p storage/framework/{cache,sessions,views} storage/logs database
chmod -R 777 storage bootstrap/cache || true
: > database/database.sqlite

DB=${DB_CONNECTION:-sqlite}
if [ "$DB" = "pgsql" ]; then
  php artisan config:clear || true
  php artisan migrate --force --seed
else
  mkdir -p storage/framework/{cache,sessions,views} storage/logs database
  chmod -R 777 storage bootstrap/cache || true
  : > database/database.sqlite
  php artisan key:generate --force || true
  php artisan config:clear || true
  php artisan migrate --force --seed
fi

php artisan serve --host 0.0.0.0 --port ${PORT:-8080}
