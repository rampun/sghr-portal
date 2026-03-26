#!/bin/bash
# force-ssl-renew.sh

echo "🔄 FORCING SSL CERTIFICATE RENEWAL"
echo "================================="

cd /var/www/sghr-portal

# Step 1: Stop everything
echo "1. Stopping all containers..."
docker compose -f docker-compose.prod.yml down

# Step 2: Remove old SSL data
echo "2. Removing old SSL data..."
rm -rf letsencrypt
mkdir -p letsencrypt
touch letsencrypt/acme.json
chmod 600 letsencrypt/acme.json

# Step 3: Verify DNS
echo "3. Verifying DNS resolution..."
SERVER_IP=$(curl -4 ifconfig.me)
DOMAIN_IP=$(dig +short sghrl.com | head -1)

echo "Server IP: $SERVER_IP"
echo "Domain IP: $DOMAIN_IP"

if [ "$SERVER_IP" != "$DOMAIN_IP" ]; then
    echo "❌ DNS does NOT match! Please fix DNS first."
    exit 1
fi

# Step 4: Verify port 80 accessibility
echo ""
echo "4. Testing port 80 accessibility..."
if curl -s -o /dev/null -w "%{http_code}" http://sghrl.com | grep -q "200\|301\|302\|404"; then
    echo "✅ Port 80 is accessible"
else
    echo "❌ Port 80 is NOT accessible"
    echo "Check firewall and Hostinger hPanel"
    exit 1
fi

# Step 5: Start Traefik with debug mode
echo ""
echo "5. Starting Traefik with debug logging..."
cat > docker-compose.debug.yml << 'EOF'
version: '3.8'

services:
  traefik:
    image: traefik:3.5.4
    container_name: traefik-debug
    command:
      - --providers.docker=true
      - --providers.docker.exposedbydefault=false
      - --entrypoints.web.address=:80
      - --entrypoints.websecure.address=:443
      - --certificatesresolvers.myresolver.acme.httpchallenge=true
      - --certificatesresolvers.myresolver.acme.httpchallenge.entrypoint=web
      - --certificatesresolvers.myresolver.acme.email=admin@sghrl.com
      - --certificatesresolvers.myresolver.acme.storage=/letsencrypt/acme.json
      - --log.level=DEBUG
      - --accesslog=true
    ports:
      - "80:80"
      - "443:443"
    volumes:
      - /var/run/docker.sock:/var/run/docker.sock:ro
      - ./letsencrypt:/letsencrypt
    restart: unless-stopped

  nginx:
    image: nginx:alpine
    container_name: nginx-debug
    labels:
      - "traefik.enable=true"
      - "traefik.http.routers.test.rule=Host(`sghrl.com`)"
      - "traefik.http.routers.test.entrypoints=websecure"
      - "traefik.http.routers.test.tls.certresolver=myresolver"
      - "traefik.http.services.test.loadbalancer.server.port=80"
    volumes:
      - ./public:/usr/share/nginx/html:ro
    restart: unless-stopped
EOF

# Start debug configuration
docker compose -f docker-compose.debug.yml up -d

# Step 6: Monitor certificate generation
echo ""
echo "6. Monitoring certificate generation (90 seconds)..."
echo "Watching for ACME challenges and certificate requests..."

for i in {1..90}; do
    if docker logs traefik-debug 2>&1 | grep -q "certificate obtained successfully"; then
        echo ""
        echo "✅ Certificate obtained successfully!"
        break
    fi
    if [ $((i % 10)) -eq 0 ]; then
        echo "  Still waiting... ($i seconds)"
        # Show recent logs
        docker logs traefik-debug 2>&1 | grep -E "acme|challenge|certificate" | tail -3
    fi
    sleep 1
done

# Step 7: Check result
echo ""
echo "7. Checking acme.json..."
if [ -s letsencrypt/acme.json ]; then
    echo "✅ acme.json has content!"
    echo ""
    echo "Certificate details:"
    cat letsencrypt/acme.json | grep -E "domain|notAfter" | head -10
    
    # Copy to production
    cp letsencrypt/acme.json letsencrypt/acme.json.production
    
    # Stop debug containers
    echo ""
    echo "8. Stopping debug containers..."
    docker compose -f docker-compose.debug.yml down
else
    echo "❌ acme.json is still empty"
    echo ""
    echo "Traefik logs (last 50 lines):"
    docker logs traefik-debug --tail 50
fi

echo ""
echo "✅ Debug complete!"