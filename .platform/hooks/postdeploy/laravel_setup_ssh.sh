#!/bin/bash

# Script de setup para Laravel via SSH
# Versión adaptada para despliegue en /var/www/html/dkapp

LOG_FILE="/var/www/html/dkapp/deployment_log.txt"
echo "Iniciando setup de Laravel - $(date)" > $LOG_FILE

# Función para loggear
log() {
    echo "$(date): $1" >> $LOG_FILE
    echo "$1"
}

# Cambiar a directorio de la app
cd /var/www/html/dkapp || { log "Error: No se pudo cambiar al directorio /var/www/html/dkapp"; exit 1; }

# Permitir ejecución de Composer como root
export COMPOSER_ALLOW_SUPERUSER=1

# Verificar que Composer exista
if ! command -v composer &> /dev/null; then
    log "Error: Composer no está instalado o no está en PATH."
    exit 1
fi

# Instalar dependencias de Composer
log "Instalando dependencias de Composer..."
if composer install --prefer-dist --no-dev --no-interaction --optimize-autoloader 2>&1 | tee -a $LOG_FILE; then
    log "Dependencias de Composer instaladas correctamente."
else
    log "Error al instalar dependencias de Composer."
    exit 1
fi

# Instalar dependencias de NPM
log "Instalando dependencias de NPM..."
if npm ci 2>&1 | tee -a $LOG_FILE; then
    log "Dependencias de NPM instaladas correctamente."
else
    log "Error al instalar dependencias de NPM."
    exit 1
fi

# Construir assets
log "Construyendo assets..."
if npm run build 2>&1 | tee -a $LOG_FILE; then
    log "Assets construidos correctamente."
else
    log "Error al construir assets."
    exit 1
fi

# Configurar permisos
log "Configurando permisos..."
chmod -R 755 storage
chmod -R 755 bootstrap/cache
chown -R www-data:www-data storage
chown -R www-data:www-data bootstrap/cache

# Limpiar y cachear configuración
log "Cacheando configuración..."
if php artisan config:cache >> $LOG_FILE 2>&1; then
    log "Configuración cacheada."
else
    log "Error al cachear configuración."
fi

log "Limpiando cache..."
if php artisan cache:clear >> $LOG_FILE 2>&1; then
    log "Cache limpiado."
else
    log "Error al limpiar cache."
fi

# Ejecutar migraciones y seeders
log "Ejecutando migraciones..."
if php artisan migrate --force >> $LOG_FILE 2>&1; then
    log "Migraciones ejecutadas."
else
    log "Error al ejecutar migraciones."
fi

log "Ejecutando seeders..."
if php artisan db:seed --force >> $LOG_FILE 2>&1; then
    log "Seeders ejecutados."
else
    log "Error al ejecutar seeders."
fi

# Comprobar configuración de Apache
log "Comprobando configuración de Apache..."

# Verificar si Apache está corriendo
if systemctl is-active --quiet apache2; then
    log "Apache está corriendo."
else
    log "Apache no está corriendo. Intentando iniciar..."
    systemctl start apache2 >> $LOG_FILE 2>&1
    if systemctl is-active --quiet apache2; then
        log "Apache iniciado correctamente."
    else
        log "Error al iniciar Apache."
    fi
fi

# Verificar virtual host
if [ -f /etc/apache2/sites-available/dkapp.conf ]; then
    log "Virtual host dkapp.conf existe."
    if apache2ctl configtest >> $LOG_FILE 2>&1; then
        log "Configuración de Apache es válida."
    else
        log "Error en configuración de Apache."
    fi
else
    log "Virtual host dkapp.conf no encontrado. Creando configuración básica..."
    cat > /etc/apache2/sites-available/dkapp.conf <<EOF
<VirtualHost *:80>
    ServerName localhost
    DocumentRoot /var/www/html/dkapp/public

    <Directory /var/www/html/dkapp/public>
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog \${APACHE_LOG_DIR}/dkapp_error.log
    CustomLog \${APACHE_LOG_DIR}/dkapp_access.log combined
</VirtualHost>
EOF
    a2ensite dkapp.conf >> $LOG_FILE 2>&1
    systemctl reload apache2 >> $LOG_FILE 2>&1
    log "Virtual host creado y habilitado."
fi

# Verificar logs de Apache
log "Verificando logs de Apache..."
if [ -f /var/log/apache2/dkapp_error.log ]; then
    tail -20 /var/log/apache2/dkapp_error.log >> $LOG_FILE
else
    log "No se encontraron logs específicos de dkapp."
fi

# Verificar conectividad básica
log "Verificando conectividad..."
if curl -s http://localhost > /dev/null; then
    log "Sitio web responde correctamente."
else
    log "Error: Sitio web no responde."
fi

log "Setup completado - $(date)"