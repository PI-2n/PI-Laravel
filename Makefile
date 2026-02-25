# ============================================
# Makefile para Producción - AWS EC2 + Docker
# ============================================
# Uso: make -f Makefile.prod [comando]
# Ejemplo: make -f Makefile.prod up
# ============================================

SHELL := /bin/bash
.PHONY: up down restart logs sh install build migrate migrate_fresh populate optimize clear artisan status backup

# ============================================
# GESTIÓN DE CONTENEDORES
# ============================================

up:
	@echo "🚀 Levantando contenedores..."
	docker compose up -d
	@echo "⏳ Esperando a que los contenedores arranquen..."
	@sleep 10
	@echo "✅ Contenedores levantados"

down:
	@echo "🛑 Deteniendo contenedores..."
	docker compose down
	@echo "✅ Contenedores detenidos"

restart:
	@echo "🔄 Reiniciando contenedores..."
	docker compose restart
	@echo "✅ Contenedores reiniciados"

status:
	@echo "📊 Estado de los contenedores:"
	docker compose ps

# ============================================
# LOGS Y ACCESO
# ============================================

logs:
	docker compose logs -f --tail=100

logs-app:
	docker compose logs -f app --tail=100

logs-nginx:
	docker compose logs -f web --tail=100

logs-db:
	docker compose logs -f db --tail=100

sh:
	docker compose exec app bash

sh-root:
	docker compose exec -u root app bash

# ============================================
# INSTALACIÓN Y BUILD
# ============================================

install:
	@echo "📦 Instalando dependencias de producción..."
	docker compose exec -u root app composer install --optimize-autoloader --no-dev --no-interaction --ignore-platform-reqs
	docker compose exec vite npm install
	docker compose exec vite npm run build
	@echo "✅ Dependencias instaladas"

build:
	@echo "🔨 Compilando frontend para producción..."
	docker compose exec vite npm run build
	@echo "✅ Frontend compilado"

# ============================================
# BASE DE DATOS
# ============================================

migrate:
	@echo "🗄️  Ejecutando migraciones..."
	docker compose exec app php artisan migrate --force
	@echo "✅ Migraciones completadas"

migrate_fresh:
	@echo "⚠️  ¡ATENCIÓN! Esto borrará todos los datos de la BD"
	@read -p "¿Estás seguro? (y/N): " confirm && [ "$$confirm" = "y" ] || (echo "Cancelado" && exit 1)
	docker compose exec app php artisan migrate:fresh --force
	@echo "✅ BD reseteada"

populate:
	@echo "🌱 Ejecutando seeders..."
	docker compose exec app php artisan db:seed
	@echo "✅ Seeders completados"

db:
	@echo "🗄️  Resetear BD y seedear..."
	@read -p "¿Estás seguro? (y/N): " confirm && [ "$$confirm" = "y" ] || (echo "Cancelado" && exit 1)
	docker compose exec app php artisan migrate:fresh --force
	docker compose exec app php artisan db:seed
	@echo "✅ BD reseteada y seedeada"

# ============================================
# OPTIMIZACIÓN Y CACHE
# ============================================

optimize:
	@echo "⚡ Optimizando Laravel para producción..."
	docker compose exec app php artisan config:cache
	docker compose exec app php artisan route:cache
	docker compose exec app php artisan view:cache
	docker compose exec app php artisan event:cache
	@echo "✅ Laravel optimizado"

clear:
	@echo "🧹 Limpiando cachés..."
	docker compose exec app php artisan config:clear
	docker compose exec app php artisan route:clear
	docker compose exec app php artisan view:clear
	docker compose exec app php artisan cache:clear
	docker compose exec app php artisan event:clear
	@echo "✅ Cachés limpiados"

# ============================================
# ARTISAN COMANDOS
# ============================================

artisan:
	@docker compose exec app php artisan $(CMD)

# ============================================
# BACKUPS
# ============================================

backup:
	@echo "💾 Creando backup de la base de datos..."
	@mkdir -p /home/backup/ftp/fitxers
	docker compose exec db mysqldump -upi -ppi pi_laravel > /home/backup/ftp/fitxers/db_backup_$$(date +%Y%m%d_%H%M%S).sql
	@echo "✅ Backup completado en /home/backup/ftp/fitxers/"

# ============================================
# DESPLIEGUE COMPLETO
# ============================================

deploy: up install migrate optimize
	@echo "🎉 ¡Despliegue completado!"
	@echo "📍 Accede a: https://app.projecteGrupG1.es"
