#!/bin/bash

echo "🔧 REBUILDING DOCKER IMAGE WITH ASSETS"
echo "======================================"

cd /var/www/sghr-portal

# Step 1: Check if Dockerfile.prod has node-builder stage
echo "1. Checking Dockerfile.prod..."
if grep -q "FROM node" Dockerfile.prod; then
    echo "✅ Dockerfile.prod has Node build stage"
else
    echo "❌ Dockerfile.prod missing Node build stage"
    echo "Please update Dockerfile.prod first"
    exit 1
fi

# Step 2: Check if package.json exists
echo "2. Checking package.json..."
if [ ! -f "package.json" ]; then
    echo "❌ package.json not found"
    exit 1
fi

# Step 3: Rebuild webapp container
echo "3. Rebuilding webapp container with assets..."
docker compose -f docker-compose.prod.yml build --no-cache webapp

# Step 4: Start containers
echo "4. Starting containers..."
docker compose -f docker-compose.prod.yml up -d

# Step 5: Wait for container to be ready
echo "5. Waiting for container..."
sleep 10

# Step 6: Verify assets
echo "6. Verifying assets..."
if docker exec webapp-prod test -f /var/www/html/public/build/manifest.json; then
    echo "✅ Assets built successfully!"
    echo ""
    echo "Build contents:"
    docker exec webapp-prod ls -la /var/www/html/public/build/
    echo ""
    echo "Asset files:"
    docker exec webapp-prod ls -la /var/www/html/public/build/assets/ | head -10
else
    echo "❌ Assets not found in container"
    echo "Check Dockerfile.prod build stage"
fi

# Step 7: Clear cache
echo "7. Clearing Laravel cache..."
docker exec webapp-prod php artisan view:clear
docker exec webapp-prod php artisan optimize:clear

# Step 8: Restart nginx
echo "8. Restarting nginx..."
docker compose -f docker-compose.prod.yml restart nginx

echo ""
echo "✅ Rebuild complete!"
echo ""
echo "Test your site: https://sghrl.com"