#!/bin/bash

echo "🔧 FIXING SHARED ASSETS WITH VOLUME"
echo "=================================="

cd /var/www/sghr-portal

# Step 1: Stop containers
echo "1. Stopping containers..."
docker compose -f docker-compose.prod.yml down

# Step 2: Remove old public volume
echo "2. Removing old public volume..."
docker volume rm sghr-app_public_assets 2>/dev/null || true

# Step 3: Create fresh public volume
echo "3. Creating fresh public volume..."
docker volume create public_assets

# Step 4: Start containers
echo "4. Starting containers..."
docker compose -f docker-compose.prod.yml up -d

# Step 5: Wait for webapp to be ready
echo "5. Waiting for webapp to be ready..."
sleep 10

# Step 6: Copy build files to shared volume
echo "6. Copying build files to shared volume..."
docker run --rm -v public_assets:/target alpine cp -r /source/. /target/ 2>/dev/null || true

# Better way: Copy directly from webapp
docker cp webapp-prod:/var/www/html/public/. $(docker volume inspect public_assets --format '{{.Mountpoint}}')/

# Step 7: Verify files in shared volume
echo "7. Verifying files in shared volume..."
VOLUME_PATH=$(docker volume inspect public_assets --format '{{.Mountpoint}}')
ls -la "$VOLUME_PATH/build/assets/" 2>/dev/null | grep css

# Step 8: Check nginx can see files
echo "8. Checking nginx can see files..."
docker exec nginx-prod ls -la /var/www/html/public/build/assets/ 2>/dev/null | grep css

# Step 9: Test access
echo "9. Testing access..."
CSS_FILE=$(docker exec nginx-prod ls /var/www/html/public/build/assets/ 2>/dev/null | grep "\.css$" | head -1)
if [ -n "$CSS_FILE" ]; then
    echo "Testing: https://sghrl.com/build/assets/$CSS_FILE"
    curl -I "https://sghrl.com/build/assets/$CSS_FILE" 2>&1 | head -3
else
    echo "❌ No CSS files found in nginx container"
fi

echo ""
echo "✅ Fix complete!"