#!/bin/bash

echo "🚀 CLEAN REDEPLOY WITH SSL"
echo "=========================="

cd /var/www/sghr-portal

# 1. Stop all containers
echo "1. Stopping containers..."
# docker compose -f docker-compose.prod.yml down

# 2. Clean SSL data
echo "2. Cleaning SSL data..."
rm -rf letsencrypt
mkdir -p letsencrypt
touch letsencrypt/acme.json
chmod 600 letsencrypt/acme.json

# 3. Create network
echo "3. Creating network..."
docker network create sghr_network 2>/dev/null || true

# 4. Verify DNS
echo "4. Verifying DNS..."
SERVER_IP=$(curl -4 ifconfig.me)
DOMAIN_IP=$(dig +short sghrl.com | head -1)

echo "Server IP: $SERVER_IP"
echo "Domain IP: $DOMAIN_IP"

if [ "$SERVER_IP" != "$DOMAIN_IP" ]; then
    echo "❌ DNS does not match! Please fix DNS first."
    echo "Expected: $SERVER_IP"
    echo "Actual: $DOMAIN_IP"
    exit 1
fi
echo "✅ DNS is correct"

# 5. Verify port 80 is accessible
echo ""
echo "5. Testing port 80..."
if curl -s -o /dev/null -w "%{http_code}" http://sghrl.com | grep -q "200\|301\|302"; then
    echo "✅ Port 80 is accessible"
else
    echo "⚠️  Port 80 test returned: $(curl -s -o /dev/null -w "%{http_code}" http://sghrl.com)"
fi

# 6. Start containers
echo ""
echo "6. Starting containers..."
docker compose -f docker-compose.prod.yml up -d

# 7. Wait and monitor SSL
echo ""
echo "7. Waiting for SSL certificate (60 seconds)..."
sleep 10

# Monitor logs
for i in {1..50}; do
    if docker logs traefik-prod 2>&1 | grep -q "certificate obtained successfully"; then
        echo "✅ SSL certificate obtained!"
        break
    fi
    if [ $((i % 10)) -eq 0 ]; then
        echo "  Still waiting... ($i seconds)"
        docker logs traefik-prod 2>&1 | grep -E "acme|certificate" | tail -3
    fi
    sleep 1
done

# 8. Check certificate
echo ""
echo "8. Checking certificate..."
if [ -s letsencrypt/acme.json ]; then
    echo "✅ acme.json has content"
    echo ""
    echo "Certificate domains:"
    cat letsencrypt/acme.json | grep -o '"domain":"[^"]*"' | head -5
else
    echo "❌ acme.json is empty"
    echo ""
    echo "Recent Traefik logs:"
    docker logs traefik-prod --tail 30
fi

# 9. Test HTTPS
echo ""
echo "9. Testing HTTPS..."
sleep 5
curl -I https://sghrl.com 2>&1 | head -3

echo ""
echo "✅ Deployment complete!"
echo ""
echo "Access your site: https://sghrl.com"
echo "phpMyAdmin: https://pma.sghrl.com"
