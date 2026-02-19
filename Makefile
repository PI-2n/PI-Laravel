SHELL := /bin/bash
.PHONY: artisan up down reset sh logs install migrate test migrate_fresh populate

up:
	docker compose up -d --build
	docker compose up -d vite
	@echo "Esperando a que los contenedores arranquen..."
	@sleep 5
	cd frontend && npm install && npm run dev

down:
	docker compose down

reset:
	docker compose down -v
	rm -rf vendor node_modules bootstrap/cache/*.php public/storage
	rm -f .env

sh:
	docker compose exec -u www-data app bash

logs:
	docker compose logs -f --tail=100

install:
	# Crear proyecto Laravel si aún no existe
	if [ ! -f artisan ]; then \
		docker compose run --rm app bash -lc 'set -e; \
		  composer create-project laravel/laravel /tmp/laravel; \
		  shopt -s dotglob; \
		  cp -an /tmp/laravel/* /var/www/html/'; \
	fi

	# Copiar .env si no existe
	cp -n .env.example .env || true

	# Instalar dependencias PHP y Node
	docker compose run --rm app bash -lc 'composer install --no-interaction --prefer-dist --optimize-autoloader'
	docker compose run --rm app bash -lc 'npm install'

	# Generar key y enlazar storage
	docker compose run --rm app bash -lc 'php artisan key:generate && php artisan storage:link'

migrate:
	# Espera a que MySQL esté listo antes de migrar
	docker compose run --rm app bash -c "until nc -z db 3306; do echo 'Waiting for DB...'; sleep 2; done; php artisan migrate"

migrate_fresh:
	docker compose run --rm app bash -c "until nc -z db 3306; do echo 'Waiting for DB...'; sleep 2; done; php artisan migrate:fresh"

populate:
	docker compose run --rm app php artisan db:seed

db:
	docker compose run --rm app bash -c "until nc -z db 3306; do echo 'Waiting for DB...'; sleep 2; done; php artisan migrate:fresh"
	docker compose run --rm app php artisan db:seed

test:
	docker compose run --rm -e APP_ENV=testing -e DB_CONNECTION=sqlite -e DB_DATABASE=:memory: app php artisan test

artisan:
	@docker compose run --rm app php artisan $(if $(CMD),$(CMD),$(cmd))
	@true
	

# Comandillo para volver al docker de daemon por defecto de linux: docker context use default