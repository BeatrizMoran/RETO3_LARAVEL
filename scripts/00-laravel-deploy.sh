#!/bin/bash

# Variables de configuración
APP_DIR="/var/www/html"  # Directorio de la aplicación Laravel
ENV_FILE=".env"          # Archivo de entorno
COMPOSER_BIN="composer"  # Comando Composer
NPM_BIN="npm"            # Comando npm
PHP_BIN="php"            # Comando PHP
ARTISAN_BIN="artisan"    # Comando Artisan
NGINX_RESTART_CMD="sudo service nginx restart"  # Comando para reiniciar Nginx

# Actualiza el código de la aplicación desde el repositorio (puede ser Git, por ejemplo)
echo "Actualizando el código fuente..."
cd $APP_DIR
git pull origin main

# Instala o actualiza las dependencias de Composer
echo "Instalando o actualizando dependencias de Composer..."
$COMPOSER_BIN install --no-dev --optimize-autoloader

# Genera una clave de aplicación si no está configurada
if [ ! -f "$APP_DIR/$ENV_FILE" ]; then
    echo "Generando clave de aplicación..."
    $PHP_BIN $ARTISAN_BIN key:generate --show
fi

# Caché de configuración y rutas
echo "Caché de configuración y rutas..."
$PHP_BIN $ARTISAN_BIN config:cache
$PHP_BIN $ARTISAN_BIN route:cache

# Crear el enlace simbólico de storage a public
echo "Creando enlace simbólico de storage a public..."
$PHP_BIN $ARTISAN_BIN storage:link

# Ejecuta las migraciones de la base de datos
echo "Ejecutando migraciones de base de datos..."
$PHP_BIN $ARTISAN_BIN migrate --force && $PHP_BIN $ARTISAN_BIN db:seed --force

# Instala dependencias de Node.js (opcional, si se utilizan)
if [ -f "$APP_DIR/package.json" ]; then
    echo "Instalando dependencias de Node.js..."
    cd $APP_DIR
    $NPM_BIN install
    $NPM_BIN run build  # Otra opción como 'dev' dependiendo de tu entorno
fi

# Reinicia Nginx
echo "Reiniciando Nginx..."
$NGINX_RESTART_CMD

# Limpia la caché de la aplicación Laravel
echo "Limpiando la caché de Laravel..."
$PHP_BIN $ARTISAN_BIN cache:clear

echo "¡Despliegue completado!"
