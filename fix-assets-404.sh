#!/bin/bash

echo "🔧 FIXING ASSETS 404 ERROR"
echo "=========================="

cd /var/www/sghr-portal

# 1. Check if file exists in webapp
echo "1. Checking file in webapp container..."
CSS_FILE=$(docker exec webapp-prod ls /var/www/html/public/build/assets/ | grep "\.css$" | head -1)
echo "CSS file: $CSS_FILE"

if [ -z "$CSS_FILE" ]; then
    echo "❌ No CSS files found in webapp container!"
    exit 1
fi

# 2. Check if nginx can see the file
echo ""
echo "2. Checking if nginx can see the file..."
docker exec nginx-prod ls -la /var/www/html/public/build/assets/ 2>/dev/null | grep css || echo "❌ Nginx cannot see the file"

# 3. Fix nginx config
echo ""
echo "3. Updating nginx config..."
cat > .docker/nginx/default.prod.conf << 'EOF'
server {
    listen 80;
    server_name sghrl.com www.sghrl.com pma.sghrl.com;
    root /var/www/html/public;
    index index.php index.html;

    location /build/ {
        alias /var/www/html/public/build/;
        try_files $uri =404;
        expires 1y;
        add_header Cache-Control "public, immutable";
        access_log off;
    }

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass webapp-prod:9000;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }
}
EOF

# 4. Copy build files to nginx if needed
echo ""
echo "4. Copying build files to nginx container..."
docker exec nginx-prod mkdir -p /var/www/html/public/build
docker cp webapp-prod:/var/www/html/public/build/. nginx-prod:/var/www/html/public/build/

# 5. Restart nginx
echo ""
echo "5. Restarting nginx..."
docker compose -f docker-compose.prod.yml restart nginx

# 6. Test the file
echo ""
echo "6. Testing file access..."
sleep 3
curl -I "https://sghrl.com/build/assets/$CSS_FILE" 2>&1 | head -5

# 7. Check nginx logs
echo ""
echo "7. Recent nginx errors:"
docker exec nginx-prod tail -5 /var/log/nginx/error.log 2>/dev/null || echo "No error log"

echo ""
echo "✅ Fix complete!"
echo ""
echo "If still not working, run:"
echo "  docker exec nginx-prod ls -la /var/www/html/public/build/assets/"