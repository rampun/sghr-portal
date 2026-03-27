#!/bin/bash

echo "🔧 FIXING 500 ERROR"
echo "==================="

cd /var/www/sghr-portal

# 1. Fix permissions
echo "1. Fixing permissions..."
docker exec webapp-prod chown -R www-data:www-data /var/www/html/storage
docker exec webapp-prod chown -R www-data:www-data /var/www/html/bootstrap/cache
docker exec webapp-prod chmod -R 755 /var/www/html/storage
docker exec webapp-prod chmod -R 755 /var/www/html/bootstrap/cache

# 2. Generate key if missing
echo "2. Generating application key..."
docker exec webapp-prod php artisan key:generate 2>/dev/null || echo "Key already exists"

# 3. Clear all caches
echo "3. Clearing caches..."
docker exec webapp-prod php artisan config:clear
docker exec webapp-prod php artisan cache:clear
docker exec webapp-prod php artisan view:clear
docker exec webapp-prod php artisan route:clear

# 4. Re-cache for production
echo "4. Re-caching for production..."
docker exec webapp-prod php artisan config:cache
docker exec webapp-prod php artisan route:cache
docker exec webapp-prod php artisan view:cache

# 5. Run migrations
echo "5. Running migrations..."
docker exec webapp-prod php artisan migrate --force

# 6. Check database connection
echo "6. Testing database..."
docker exec webapp-prod php artisan tinker --execute="try { DB::connection()->getPdo(); echo '✅ Database OK'; } catch (Exception \$e) { echo '❌ DB Error: ' . \$e->getMessage(); }"

# 7. Restart containers
echo "7. Restarting containers..."
docker compose -f docker-compose.prod.yml restart webapp
docker compose -f docker-compose.prod.yml restart nginx

sleep 5

# 8. Test again
echo "8. Testing HTTPS..."
curl -I https://sghrl.com 2>&1 | head -3

echo ""
echo "✅ Fix complete!"