# Makefile
.PHONY: help dev prod dev-down prod-down dev-build prod-build

help:
	@echo "Available commands:"
	@echo "  make dev        		- Start development environment"
	@echo "  make dev-down   		- Stop development environment"
	@echo "  make dev-build  		- Rebuild development environment"
	@echo "  make prod       		- Start production environment"
	@echo "  make prod-down  		- Stop production environment"
	@echo "  make prod-build 		- Rebuild production environment"
	@echo "  make logs       		- View logs"
	@echo "  make shell      		- Open shell in webapp container"
	@echo "  make clear-cache-prod 	- Clear cache in production"

dev:
	docker network create sghr_network 2>/dev/null || true
	docker compose -f docker-compose.dev.yml up -d

dev-down:
	docker compose -f docker-compose.dev.yml down

dev-build:
	docker compose -f docker-compose.dev.yml build --no-cache
	docker compose -f docker-compose.dev.yml up -d

prod:
	docker network create sghr_network 2>/dev/null || true
	docker compose -f docker-compose.prod.yml up -d

prod-down:
	docker compose -f docker-compose.prod.yml down

prod-build:
	docker compose -f docker-compose.prod.yml build --no-cache
	docker compose -f docker-compose.prod.yml up -d

logs:
	docker compose -f docker-compose.dev.yml logs -f

shell:
	docker compose -f docker-compose.dev.yml exec webapp sh

shell-prod:
	docker compose -f docker-compose.prod.yml exec webapp sh

clear-cache-prod:
	docker compose exec webapp php artisan cache:clear && php artisan config:clear && php artisan optimize
