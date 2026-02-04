#!/bin/bash

# Script para instalar tmux y ejecutar ngrok http 80 en segundo plano
LOG_FILE="/var/www/html/dkapp/ngrok_tmux_log.txt"
echo "Iniciando setup de ngrok/tmux - $(date)" > $LOG_FILE

log() {
    echo "$(date): $1" >> $LOG_FILE
    echo "$1"
}

# Mostrar IPs del servidor de forma clara
log "=============================="
log "IP(s) del servidor (IPv4):"
ip -4 addr show 2>/dev/null | awk '/inet /{print " - "$2" ("$NF")"}' | tee -a $LOG_FILE
log "IPs (hostname -I):"
hostname -I 2>/dev/null | awk '{print " - "$0}' | tee -a $LOG_FILE
log "=============================="

# Instalar tmux si no existe
if ! command -v tmux &> /dev/null; then
    log "tmux no encontrado. Instalando..."
    if apt update >> $LOG_FILE 2>&1 && apt install -y tmux >> $LOG_FILE 2>&1; then
        log "tmux instalado correctamente."
    else
        log "Error instalando tmux."
        exit 1
    fi
else
    log "tmux ya está instalado."
fi

# Instalar ngrok si no existe
if ! command -v ngrok &> /dev/null; then
    log "ngrok no encontrado. Descargando..."
    ARCH="linux_amd64"
    TMP_DIR="/tmp/ngrok_install"
    mkdir -p "$TMP_DIR"
    if curl -fsSL "https://bin.equinox.io/c/bNyj1mQVY4c/ngrok-v3-stable-${ARCH}.tgz" -o "$TMP_DIR/ngrok.tgz" >> $LOG_FILE 2>&1; then
        tar -xzf "$TMP_DIR/ngrok.tgz" -C "$TMP_DIR" >> $LOG_FILE 2>&1
        mv "$TMP_DIR/ngrok" /usr/local/bin/ngrok
        chmod +x /usr/local/bin/ngrok
        log "ngrok instalado correctamente."
    else
        log "Error descargando ngrok."
        exit 1
    fi
else
    log "ngrok ya está instalado."
fi

# Configurar authtoken si está disponible
if [ -n "$NGROK_AUTHTOKEN" ]; then
    log "Configurando authtoken de ngrok..."
    ngrok config add-authtoken "$NGROK_AUTHTOKEN" >> $LOG_FILE 2>&1
else
    log "NGROK_AUTHTOKEN no proporcionado. Se ejecutará sin authtoken."
fi

# Reiniciar sesión tmux de ngrok
if tmux has-session -t ngrok 2>/dev/null; then
    tmux kill-session -t ngrok
    log "Sesión tmux existente de ngrok cerrada."
fi

log "Iniciando ngrok http 80 en segundo plano con tmux..."
tmux new-session -d -s ngrok "ngrok http 80"

if tmux has-session -t ngrok 2>/dev/null; then
    log "ngrok iniciado en segundo plano (tmux session: ngrok)."
    log "Para ver la URL pública de ngrok: ejecuta 'ngrok http 80' en el servidor o consulta http://127.0.0.1:4040/status" 
else
    log "Error iniciando ngrok en tmux."
    exit 1
fi

log "Setup de ngrok/tmux completado."
