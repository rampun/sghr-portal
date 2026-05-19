#!/bin/sh
# docker/entrypoint.sh
# Runs on every webapp container start. Two jobs:
#   1. Refresh the shared public/ volume from the image-baked snapshot
#      so nginx serves the assets from the LATEST image rebuild, not
#      whatever was first written to the named volume.
#   2. Ensure storage and bootstrap/cache are writable by www-data.
# Then exec the main process (php-fpm).
set -e

APP_DIR=/var/www/html
SNAPSHOT_DIR=/opt/public-snapshot

# Asset sync: only runs if the image baked a snapshot (i.e. prod stage).
# Dev skips this — the bind mount owns /var/www/html/public.
if [ -d "$SNAPSHOT_DIR" ]; then
    mkdir -p "$APP_DIR/public"
    # rsync would be nicer but isn't in php-fpm-alpine; cp -a is fine
    # since the snapshot is the source of truth on each start.
    cp -a "$SNAPSHOT_DIR"/. "$APP_DIR/public/"
fi

# A host bind mount of ./storage can hide the framework subdirs the image
# pre-creates. Re-create them so Laravel doesn't 500 on a fresh deploy.
mkdir -p \
    "$APP_DIR/storage/framework/sessions" \
    "$APP_DIR/storage/framework/views" \
    "$APP_DIR/storage/framework/cache/data" \
    "$APP_DIR/storage/logs" \
    "$APP_DIR/storage/app/public" \
    "$APP_DIR/bootstrap/cache"

# Permissions: idempotent, cheap.
chown -R www-data:www-data \
    "$APP_DIR/storage" \
    "$APP_DIR/bootstrap/cache" \
    "$APP_DIR/public" 2>/dev/null || true
chmod -R ug+rwX \
    "$APP_DIR/storage" \
    "$APP_DIR/bootstrap/cache" 2>/dev/null || true

exec "$@"
