#!/bin/bash

# Script para comprobar y configurar Apache en Debian
LOG_FILE="/var/www/html/dkapp/apache_setup_log.txt"
echo "Iniciando verificación de Apache - $(date)" > $LOG_FILE

log() {
    echo "$(date): $1" >> $LOG_FILE
    echo "$1"
}

# Instalar Apache si no existe
if ! command -v apache2 &> /dev/null; then
    log "Apache no encontrado. Instalando..."
    if apt update >> $LOG_FILE 2>&1 && apt install -y apache2 >> $LOG_FILE 2>&1; then
        log "Apache instalado correctamente."
        systemctl enable apache2 >> $LOG_FILE 2>&1
    else
        log "Error instalando Apache."
        exit 1
    fi
else
    log "Apache ya está instalado."
fi

# Asegurar PHP en Apache (módulo)
if ! apache2ctl -M 2>/dev/null | grep -q "php"; then
    log "Módulo PHP no detectado en Apache. Instalando libapache2-mod-php..."

    PHP_VER=$(php -r 'echo PHP_MAJOR_VERSION.".".PHP_MINOR_VERSION;' 2>/dev/null)
    if [ -z "$PHP_VER" ]; then
        log "No se pudo detectar versión de PHP. Instalando metapaquete libapache2-mod-php."
        if apt update >> $LOG_FILE 2>&1 && apt install -y libapache2-mod-php >> $LOG_FILE 2>&1; then
            log "libapache2-mod-php instalado."
        else
            log "Error instalando libapache2-mod-php."
            exit 1
        fi
    else
        log "PHP detectado: $PHP_VER. Instalando libapache2-mod-php$PHP_VER..."
        if apt update >> $LOG_FILE 2>&1 && apt install -y "libapache2-mod-php$PHP_VER" >> $LOG_FILE 2>&1; then
            log "libapache2-mod-php$PHP_VER instalado."
            a2enmod "php$PHP_VER" >> $LOG_FILE 2>&1 || true
        else
            log "Fallo al instalar libapache2-mod-php$PHP_VER. Probando metapaquete libapache2-mod-php..."
            if apt install -y libapache2-mod-php >> $LOG_FILE 2>&1; then
                log "libapache2-mod-php instalado."
            else
                log "Error instalando libapache2-mod-php."
                exit 1
            fi
        fi
    fi
else
    log "Módulo PHP ya está habilitado en Apache."
fi

# Habilitar mod_rewrite
log "Habilitando mod_rewrite..."
if a2enmod rewrite >> $LOG_FILE 2>&1; then
    log "mod_rewrite habilitado."
else
    log "Error al habilitar mod_rewrite."
fi

# Crear VirtualHost
log "Configurando VirtualHost dkapp..."
cat > /etc/apache2/sites-available/dkapp.conf <<EOF
<VirtualHost *:80>
    ServerName localhost
    DocumentRoot /var/www/html/dkapp/public

    DirectoryIndex index.php index.html

    <Directory /var/www/html/dkapp/public>
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog \${APACHE_LOG_DIR}/dkapp_error.log
    CustomLog \${APACHE_LOG_DIR}/dkapp_access.log combined
</VirtualHost>
EOF

if a2ensite dkapp.conf >> $LOG_FILE 2>&1; then
    log "VirtualHost dkapp habilitado."
else
    log "Error al habilitar VirtualHost."
fi

# Deshabilitar sitio por defecto si existe
if [ -f /etc/apache2/sites-enabled/000-default.conf ]; then
    a2dissite 000-default.conf >> $LOG_FILE 2>&1
    log "Sitio por defecto deshabilitado."
fi

# Validar configuración
log "Validando configuración Apache..."
if apache2ctl configtest >> $LOG_FILE 2>&1; then
    log "Configuración Apache OK."
else
    log "Error en configuración Apache."
    exit 1
fi

# Reiniciar servicio
log "Reiniciando Apache..."
if systemctl restart apache2 >> $LOG_FILE 2>&1; then
    log "Apache reiniciado correctamente."
else
    log "Error al reiniciar Apache."
    exit 1
fi

# Comprobar estado
if systemctl is-active --quiet apache2; then
    log "Apache está activo."
else
    log "Apache no está activo."
    exit 1
fi

log "Verificación y configuración de Apache completada."
