include .env

.env: ## Setup .env from example
	cp .env.example .env

up: ## Start the Docker Compose stack.
	docker-compose up -d

down: ## Stop the Docker Compose stack.
	docker-compose down

webapp: ## Run bash in the app service.
	docker-compose exec webapp sh

clear-cache:
	docker-compose exec webapp php artisan optimize