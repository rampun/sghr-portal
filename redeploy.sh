#!/bin/bash

echo "🚀 DEPLOYING CONSOLIDATED SSL CERTIFICATE"
echo "========================================"

cd /var/www/sghr-portal

# 1. Stop all containers
echo "1. Stopping containers..."
docker compose -f docker-compose.prod.yml down

# 2. Clean old SSL data
echo "2. Cleaning old SSL data..."
rm -rf letsencrypt
mkdir -p letsencrypt
touch letsencrypt/acme.json
chmod 600 letsencrypt/acme.json

# 3. Create network
echo "3. Creating network..."
docker network create sghr_network 2>/dev/null || true

# 4. Verify DNS for all domains
echo "4. Verifying DNS for all domains..."
SERVER_IP=$(curl -4 ifconfig.me)
echo "Server IP: $SERVER_IP"

for domain in sghrl.com www.sghrl.com pma.sghrl.com; do
    DOMAIN_IP=$(dig +short $domain | head -1)
    if [ "$SERVER_IP" = "$DOMAIN_IP" ]; then
        echo "✅ $domain -> $DOMAIN_IP"
    else
        echo "⚠️  $domain -> $DOMAIN_IP (expected $SERVER_IP)"
    fi
done

# 5. Start containers 
echo ""
echo "5. Starting containers..."
docker compose -f docker-compose.prod.yml up -d

# 6. Monitor certificate generation
echo ""
echo "6. Waiting for SSL certificate (60 seconds)..."
echo "This will issue ONE certificate for all domains:"
echo "  - sghrl.com"
echo "  - www.sghrl.com"
echo "  - pma.sghrl.com"
echo ""

for i in {1..60}; do
    if docker logs traefik-prod 2>&1 | grep -q "certificate obtained successfully"; then
        echo ""
        echo "✅ SSL certificate obtained successfully!"
        break
    fi
    if [ $((i % 10)) -eq 0 ]; then
        echo "  Still waiting... ($i seconds)"
        docker logs traefik-prod 2>&1 | grep -E "acme|certificate" | tail -2
    fi
    sleep 1
done

# 7. Check certificate
echo ""
echo "7. Checking certificate..."
if [ -s letsencrypt/acme.json ]; then
    echo "✅ acme.json has content"
    echo ""
    echo "Certificate contains domains:"
    cat letsencrypt/acme.json | grep -o '"domain":"[^"]*"' | head -5
else
    echo "❌ acme.json is empty"
    echo ""
    echo "Recent Traefik logs:"
    docker logs traefik-prod --tail 30
fi

# 8. Test all domains
echo ""
echo "8. Testing HTTPS for all domains..."
sleep 5

for domain in sghrl.com www.sghrl.com pma.sghrl.com; do
    echo -n "$domain: "
    curl -s -o /dev/null -w "%{http_code}" https://$domain
    echo ""
done

echo ""
echo "✅ Deployment complete!"
echo ""
echo "Your site is now secured with ONE certificate covering:"
echo "  https://sghrl.com"
echo "  https://www.sghrl.com"
echo "  https://pma.sghrl.com"