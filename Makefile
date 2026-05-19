# Makefile
# Wrapper around `docker compose --profile {dev,prod}`.
.PHONY: help dev dev-down dev-build prod prod-down prod-build \
        logs logs-prod shell shell-prod migrate-prod clear-cache-prod

DEV  := docker compose --profile dev
PROD := docker compose --profile prod

help:
	@echo "Available commands:"
	@echo "  make dev                - Start development environment"
	@echo "  make dev-down           - Stop development environment"
	@echo "  make dev-build          - Rebuild & start development environment"
	@echo "  make prod               - Start production environment"
	@echo "  make prod-down          - Stop production environment"
	@echo "  make prod-build         - Rebuild & start production environment"
	@echo "  make logs               - Tail dev logs"
	@echo "  make logs-prod          - Tail prod logs"
	@echo "  make shell              - Shell into dev webapp container"
	@echo "  make shell-prod         - Shell into prod webapp container"
	@echo "  make migrate-prod       - Run migrations in prod"
	@echo "  make clear-cache-prod   - Clear Laravel cache in prod"

# -------- Dev --------
dev:
	$(DEV) up -d

dev-down:
	$(DEV) down

dev-build:
	$(DEV) build --no-cache
	$(DEV) up -d

# -------- Prod --------
prod:
	$(PROD) up -d

prod-down:
	$(PROD) down

prod-build:
	$(PROD) build --no-cache
	$(PROD) up -d

# -------- Ops --------
logs:
	$(DEV) logs -f

logs-prod:
	$(PROD) logs -f

shell:
	$(DEV) exec webapp sh

shell-prod:
	$(PROD) exec webapp-prod sh

migrate-prod:
	$(PROD) exec -T webapp-prod php artisan migrate --force

clear-cache-prod:
	$(PROD) exec -T webapp-prod sh -c "php artisan cache:clear && php artisan config:clear && php artisan view:clear && php artisan optimize"
