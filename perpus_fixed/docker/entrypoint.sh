#!/bin/bash
set -e

echo "==> [DigiLib] Starting entrypoint..."

# ── 1. Setup .env ──────────────────────────────────────────────
if [ ! -f /var/www/.env ]; then
    echo "==> .env not found, copying from .env.example"
    cp /var/www/.env.example /var/www/.env
fi

sed -i "s/^DB_HOST=.*/DB_HOST=mysql/"                        /var/www/.env
sed -i "s/^DB_DATABASE=.*/DB_DATABASE=perpustakaan/"         /var/www/.env
sed -i "s/^DB_USERNAME=.*/DB_USERNAME=perpus/"               /var/www/.env
sed -i "s/^DB_PASSWORD=.*/DB_PASSWORD=secret/"               /var/www/.env
sed -i "s/^APP_URL=.*/APP_URL=http:\/\/localhost:8080/"      /var/www/.env
sed -i "s/^APP_DEBUG=.*/APP_DEBUG=true/"                     /var/www/.env

# ── 2. Generate APP_KEY if missing ────────────────────────────
APP_KEY_VAL=$(grep "^APP_KEY=" /var/www/.env | cut -d= -f2)
if [ -z "$APP_KEY_VAL" ]; then
    echo "==> Generating APP_KEY..."
    php /var/www/artisan key:generate --force
fi

# ── 3. Wait for MySQL to be ready ────────────────────────────
echo "==> Waiting for MySQL..."
MAX_TRIES=30
COUNT=0
until mysql -h mysql -uroot -psecret -e "SELECT 1" >/dev/null 2>&1; do
    COUNT=$((COUNT+1))
    if [ $COUNT -ge $MAX_TRIES ]; then
        echo "ERROR: MySQL not ready after ${MAX_TRIES}s. Exiting."
        exit 1
    fi
    echo "   Attempt $COUNT/$MAX_TRIES — retrying in 2s..."
    sleep 2
done
echo "==> MySQL is ready!"

# ── 4. Run migrations & seed (only once) ─────────────────────
TABLE_EXISTS=$(mysql -h mysql -uroot -psecret perpustakaan \
    -e "SHOW TABLES LIKE 'users';" 2>/dev/null | grep -c "users" || true)

if [ "$TABLE_EXISTS" = "0" ]; then
    echo "==> Running migrations and seeders..."
    php /var/www/artisan migrate --seed --force
    echo "==> Done!"
else
    echo "==> Database already seeded, skipping."
fi

# ── 5. Storage link ───────────────────────────────────────────
if [ ! -L /var/www/public/storage ]; then
    echo "==> Creating storage symlink..."
    php /var/www/artisan storage:link
fi

# ── 6. Clear & cache config ──────────────────────────────────
php /var/www/artisan config:clear
php /var/www/artisan view:clear

echo "==> [DigiLib] Ready! Starting php-fpm..."
exec "$@"
