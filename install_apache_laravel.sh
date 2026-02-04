#!/bin/bash

# Script de instalación manual para Apache y Laravel en Debian
# Ejecutar como root o con sudo

LOG_FILE="/root/install_apache_laravel.log"
echo "Iniciando instalación - $(date)" > $LOG_FILE

SUCCESS_COUNT=0
FAIL_COUNT=0

# Función para loggear y contar
log_success() {
    echo "$(date): SUCCESS - $1" >> $LOG_FILE
    echo "✓ $1"
    ((SUCCESS_COUNT++))
}

log_fail() {
    echo "$(date): FAIL - $1" >> $LOG_FILE
    echo "✗ $1"
    ((FAIL_COUNT++))
}

log_info() {
    echo "$(date): INFO - $1" >> $LOG_FILE
    echo "ℹ $1"
}

# Actualizar sistema
log_info "Actualizando lista de paquetes..."
if apt update >> $LOG_FILE 2>&1; then
    log_success "Lista de paquetes actualizada."
else
    log_fail "Error al actualizar lista de paquetes."
fi

# Instalar Apache
if ! dpkg -l | grep -q apache2; then
    log_info "Instalando Apache2..."
    if apt install -y apache2 >> $LOG_FILE 2>&1; then
        log_success "Apache2 instalado."
        systemctl enable apache2 >> $LOG_FILE 2>&1
    else
        log_fail "Error al instalar Apache2."
    fi
else
    log_info "Apache2 ya está instalado."
fi

# Instalar PHP 8.5 y extensiones
if ! dpkg -l | grep -q php8.5; then
    log_info "Instalando dependencias para PHP..."
    if apt install -y wget lsb-release >> $LOG_FILE 2>&1; then
        log_success "Dependencias instaladas."
    else
        log_fail "Error instalando dependencias para PHP."
        exit 1
    fi
    
    log_info "Agregando clave GPG para repositorio PHP..."
    if curl -fsSL https://packages.sury.org/php/apt.gpg | gpg --dearmor | tee /usr/share/keyrings/php.gpg > /dev/null >> $LOG_FILE 2>&1; then
        log_success "Clave GPG agregada."
    else
        log_fail "Error agregando clave GPG."
        exit 1
    fi
    
    log_info "Agregando repositorio PHP..."
    CODENAME=$(lsb_release -sc)
    log_info "Codename detectada: $CODENAME"
    if echo "deb [signed-by=/usr/share/keyrings/php.gpg] https://packages.sury.org/php/ $CODENAME main" | tee /etc/apt/sources.list.d/php.list >> $LOG_FILE 2>&1; then
        log_success "Repositorio PHP agregado."
    else
        log_fail "Error agregando repositorio PHP."
        exit 1
    fi
    
    log_info "Actualizando lista de paquetes para PHP..."
    if apt update >> $LOG_FILE 2>&1; then
        log_success "Lista de paquetes actualizada para PHP."
    else
        log_fail "Error actualizando lista de paquetes para PHP. Codename: $CODENAME"
        exit 1
    fi
    
    log_info "Instalando PHP 8.5 y extensiones..."
    # Quitar redirect para ver progreso en consola
    if apt install -y php8.5 php8.5-cli php8.5-common php8.5-mysql php8.5-zip php8.5-gd php8.5-mbstring php8.5-curl php8.5-xml php8.5-bcmath; then
        log_success "PHP 8.5 y extensiones instalados."
    else
        log_fail "Error al instalar PHP 8.5."
        exit 1
    fi
else
    log_info "PHP 8.5 ya está instalado."
fi

# Instalar MySQL (MariaDB en Debian)
if ! dpkg -l | grep -q mariadb-server; then
    log_info "Instalando MariaDB Server..."
    # Quitar redirect para ver progreso
    if apt install -y mariadb-server; then
        log_success "MariaDB Server instalado."
        systemctl enable mariadb >> $LOG_FILE 2>&1
        
        # Configurar MariaDB
        log_info "Configurando MariaDB..."
        DB_NAME="dkapp"
        DB_USER="dkapp_user"
        DB_PASS=$(openssl rand -base64 12)
        
        log_info "Creando base de datos y usuario..."
        if mysql -u root -e "CREATE DATABASE IF NOT EXISTS $DB_NAME;" >> $LOG_FILE 2>&1 && \
           mysql -u root -e "CREATE USER IF NOT EXISTS '$DB_USER'@'localhost' IDENTIFIED BY '$DB_PASS';" >> $LOG_FILE 2>&1 && \
           mysql -u root -e "GRANT ALL PRIVILEGES ON $DB_NAME.* TO '$DB_USER'@'localhost';" >> $LOG_FILE 2>&1 && \
           mysql -u root -e "FLUSH PRIVILEGES;" >> $LOG_FILE 2>&1; then
            log_success "Base de datos y usuario MariaDB configurados."
        else
            log_fail "Error configurando base de datos y usuario."
            exit 1
        fi
        
        # Crear .env
        log_info "Creando archivo .env..."
        ENV_FILE="/var/www/html/dkapp/.env"
        if [ -f "/var/www/html/dkapp/.env.example" ]; then
            cp /var/www/html/dkapp/.env.example $ENV_FILE
        else
            # Crear .env básico si no hay .env.example
            cat > $ENV_FILE <<EOF
APP_NAME=DKAPP
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=http://localhost

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=error

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=$DB_NAME
DB_USERNAME=$DB_USER
DB_PASSWORD=$DB_PASS

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="\${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_HOST=
PUSHER_PORT=443
PUSHER_SCHEME=https
PUSHER_APP_CLUSTER=mt1

VITE_APP_NAME="\${APP_NAME}"
VITE_PUSHER_APP_KEY="\${PUSHER_APP_KEY}"
VITE_PUSHER_HOST="\${PUSHER_HOST}"
VITE_PUSHER_PORT="\${PUSHER_PORT}"
VITE_PUSHER_SCHEME="\${PUSHER_SCHEME}"
VITE_PUSHER_APP_CLUSTER="\${PUSHER_APP_CLUSTER}"
EOF
        fi
        
        # Actualizar credenciales en .env
        sed -i "s/DB_DATABASE=.*/DB_DATABASE=$DB_NAME/" $ENV_FILE
        sed -i "s/DB_USERNAME=.*/DB_USERNAME=$DB_USER/" $ENV_FILE
        sed -i "s/DB_PASSWORD=.*/DB_PASSWORD=$DB_PASS/" $ENV_FILE
        
        # Generar APP_KEY
        cd /var/www/html/dkapp
        if php artisan key:generate >> $LOG_FILE 2>&1; then
            log_success "APP_KEY generada."
        else
            log_fail "Error generando APP_KEY."
        fi
        
        log_success "Archivo .env creado con credenciales únicas."
        
        # Mostrar credenciales
        echo ""
        echo "=== CREDENCIALES DE BASE DE DATOS ==="
        echo "Base de datos: $DB_NAME"
        echo "Usuario: $DB_USER"
        echo "Contraseña: $DB_PASS"
        echo "Archivo .env creado en: $ENV_FILE"
        echo ""
        
    else
        log_fail "Error al instalar MariaDB Server."
        exit 1
    fi
else
    log_info "MariaDB Server ya está instalado."
fi

# Instalar Composer
if ! command -v composer &> /dev/null; then
    log_info "Instalando Composer..."
    if curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer >> $LOG_FILE 2>&1; then
        log_success "Composer instalado."
    else
        log_fail "Error al instalar Composer."
    fi
else
    log_info "Composer ya está instalado."
fi

# Instalar Node.js y NPM
if ! command -v node &> /dev/null; then
    log_info "Instalando Node.js y NPM..."
    if curl -fsSL https://deb.nodesource.com/setup_20.x | bash - >> $LOG_FILE 2>&1 && \
       apt install -y nodejs >> $LOG_FILE 2>&1; then
        log_success "Node.js y NPM instalados."
    else
        log_fail "Error al instalar Node.js."
    fi
else
    log_info "Node.js ya está instalado."
fi

# Habilitar mod_rewrite
log_info "Habilitando mod_rewrite..."
if a2enmod rewrite >> $LOG_FILE 2>&1; then
    log_success "mod_rewrite habilitado."
else
    log_fail "Error al habilitar mod_rewrite."
fi

# Crear directorio para la app
log_info "Creando directorio para la aplicación..."
if mkdir -p /var/www/html/dkapp >> $LOG_FILE 2>&1; then
    log_success "Directorio /var/www/html/dkapp creado."
else
    log_fail "Error al crear directorio."
fi

# Configurar permisos
log_info "Configurando permisos..."
chown -R www-data:www-data /var/www/html/dkapp >> $LOG_FILE 2>&1
log_success "Permisos configurados."

# Crear virtual host
log_info "Creando virtual host para dkapp..."
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

if a2ensite dkapp.conf >> $LOG_FILE 2>&1 && a2dissite 000-default.conf >> $LOG_FILE 2>&1; then
    log_success "Virtual host configurado."
else
    log_fail "Error al configurar virtual host."
fi

# Reiniciar servicios
log_info "Reiniciando Apache..."
if systemctl restart apache2 >> $LOG_FILE 2>&1; then
    log_success "Apache reiniciado."
else
    log_fail "Error al reiniciar Apache."
fi

if systemctl is-active --quiet mariadb; then
    log_info "MariaDB ya está corriendo."
else
    log_info "Iniciando MariaDB..."
    if systemctl start mariadb >> $LOG_FILE 2>&1; then
        log_success "MariaDB iniciado."
    else
        log_fail "Error al iniciar MariaDB."
    fi
fi

# Resumen
echo ""
echo "=== RESUMEN DE INSTALACIÓN ==="
echo "Éxitos: $SUCCESS_COUNT"
echo "Fallos: $FAIL_COUNT"
echo "Log completo en: $LOG_FILE"
echo ""

if [ $FAIL_COUNT -eq 0 ]; then
    echo "✓ Instalación completada exitosamente."
else
    echo "⚠ Instalación completada con $FAIL_COUNT errores. Revisa el log."
fi

echo "Instrucciones siguientes:"
echo "- La base de datos MariaDB está configurada con credenciales únicas."
echo "- El archivo .env ya está creado con las credenciales."
echo "- Despliega tu aplicación Laravel en /var/www/html/dkapp"
echo "- Ejecuta 'composer install' y 'npm install' en el directorio de la app si es necesario."
echo "- Las migraciones y seeders se ejecutarán automáticamente en el despliegue." 