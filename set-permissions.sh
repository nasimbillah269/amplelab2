#!/usr/bin/env bash
# Production permissions for a cPanel Laravel deploy.
# Run from the project root:  bash set-permissions.sh
set -e
cd "$(dirname "$0")"

echo "Setting directory permissions to 755 ..."
find . -type d -not -path './vendor/*' -exec chmod 755 {} +

echo "Setting file permissions to 644 ..."
find . -type f -not -path './vendor/*' -exec chmod 644 {} +

echo "Making writable paths group-writable (775) ..."
chmod -R 775 storage bootstrap/cache

echo "Locking down .env (600) ..."
[ -f .env ] && chmod 600 .env

echo "Restoring exec bit on scripts / artisan ..."
chmod 755 artisan set-permissions.sh 2>/dev/null || true

echo "Done."
