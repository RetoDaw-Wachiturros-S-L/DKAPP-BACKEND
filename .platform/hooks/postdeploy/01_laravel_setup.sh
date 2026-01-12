#!/bin/bash

# Post-deploy hook para Elastic Beanstalk
set -e

cd /var/app/current || exit 1

echo "Creating storage directories..."
mkdir -p storage/framework/cache/data storage/framework/sessions storage/framework/views storage/framework/testing storage/logs

echo "Setting permissions..."
chmod -R 775 storage bootstrap/cache
chown -R webapp:webapp storage bootstrap/cache

# Ejecutar migraciones (solo en la instancia líder)
if [ -f /opt/elasticbeanstalk/bin/get-config ] && [ "$(/opt/elasticbeanstalk/bin/get-config container -k is_leader)" = "true" ]; then
  echo "Running migrations on leader instance..."
  php artisan migrate --force || echo "Migrations failed"
  
  echo "Optimizing Laravel..."
  php artisan optimize || echo "Optimization failed"
fi

echo "Clearing Laravel caches..."
php artisan config:clear || true
php artisan cache:clear || true
php artisan view:clear || true

echo "Post-deploy completado exitosamente"

