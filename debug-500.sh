#!/bin/bash

echo "🔍 DEBUGGING 500 ERROR"
echo "======================"

cd /var/www/sghr-portal

# echo "1. Checking Nginx error logs..."
# docker exec nginx-prod tail -20 /var/log/nginx/error.log
# echo ""

echo "2. Checking PHP-FPM logs..."
docker logs webapp-prod --tail 30
echo ""

echo "3. Checking Laravel logs..."
docker exec webapp-prod tail -30 /var/www/html/storage/logs/laravel.log 2>/dev/null || echo "No laravel.log found"
echo ""

echo "4. Checking .env file..."
docker exec webapp-prod cat /var/www/html/.env 2>/dev/null | head -10 || echo ".env file missing"
echo ""

echo "5. Testing database connection..."
docker exec webapp-prod php artisan tinker --execute="try { DB::connection()->getPdo(); echo '✅ Database connected!'; } catch (Exception \$e) { echo '❌ Error: ' . \$e->getMessage(); }"
echo ""

echo "6. Checking storage permissions..."
docker exec webapp-prod ls -la /var/www/html/storage/
echo ""

echo "7. Testing PHP-FPM directly..."
docker exec webapp-prod php -r "echo 'PHP is working';"
echo ""

echo "8. Testing Laravel routes..."
docker exec webapp-prod php artisan route:list 2>&1 | head -20