include .env

.env:
	cp .env.example .env

up:
	docker-compose up -d

down:
	docker-compose down

webapp:
	docker-compose exec webapp sh

clear-cache:
	docker-compose exec webapp php artisan optimize:clear

restart:
	docker-compose down && docker-compose up -d