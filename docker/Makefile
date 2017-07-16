.DEFAULT_GOAL := help
# docker-registry для образов

prepare-project : create-env
create-project : dc-build dc-up build-backend

####################################################################################################
# Подготовительные действия
####################################################################################################

create-env: ## Создание .env-файлов для docker-compose (используется при сборке/запуске образов) и основного проекта
	cp -u ../.env.develop ../.env


####################################################################################################
# Сборка бекенда/фронтенда основного проекта
####################################################################################################
build-backend: ## Сборка бекенда (composer install & zf routes compile)
	docker-compose exec --user www-data test-php-fpm sh -c "composer install"
	docker-compose exec --user www-data test-php-fpm sh -c "php artisan doctrine:migrations:migrate"

help:
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-16s\033[0m %s\n", $$1, $$2}'

####################################################################################################
# Подключение к консоли контейнеров
####################################################################################################
console-workspace: ## Подключение к консоли контейнера workspace (пользователь www-data)
	docker-compose exec --user www-data test-php-fpm bash

console-nginx: ## Подключение к консоли контейнера nginx (пользователь root)
	docker-compose exec nginx bash

console-php-fpm: ## Подключение к консоли контейнера php-fmp (пользователь root)
	docker-compose exec php-fpm bash


####################################################################################################
# Управление контейнерами с помощью docker-compose (dc)
####################################################################################################
dc-build: ## Сборка docker-образов согласно инструкциям из docker-compose.yml
	docker-compose build

dc-up: ## Создание и запуск docker-контейнеров, описанных в docker-compose.yml
	docker-compose up -d

dc-down: ## Остановка и УДАЛЕНИЕ docker-контейнеров, описанных в docker-compose.yml
	docker-compose down

dc-stop: ## Остановка docker-контейнеров, описанных в docker-compose.yml
	docker-compose stop

dc-start: ## Запуск docker-контейнеров, описанных в docker-compose.yml
	docker-compose start
