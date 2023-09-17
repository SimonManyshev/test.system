QUIET := @
ARGS=$(filter-out $@, $(MAKECMDGOALS))

.DEFAULT_GOAL=help
.PHONY=help
app_container=php

ifeq ($(OS),Windows_NT)
	CHECK_CS_COMMAND = docker-compose exec $(app_container) bin/check-cs.sh
else
	CHECK_CS_COMMAND = bin/check-cs.sh
endif

help: ## Показать возможные команды
	$(QUIET) grep -E '^[a-zA-Z0-9_-]+:.*?## .*$$' $(MAKEFILE_LIST) \
	| sed -n 's/^\(.*\): \(.*\)##\(.*\)/\1;\3/p' \
	| column -t -s ';' | sort

init-db-win: create-db-user create-db set-db-grant

create-db-user:
	 docker exec -it -u postgres ts-db bash psql
	"CREATE USER ts_dba WITH ENCRYPTED PASSWORD 'ts_dba';"

create-db:
	docker exec -it -u postgres ts-db bash psql "CREATE DATABASE ts;"

set-db-grant:
	docker exec -it -u postgres ts-db bash psql "GRANT ALL PRIVILEGES ON DATABASE ts TO ts_dba;"

cache-clear: ## Очистить и прогреть кеш приложения
	$(QUIET) docker-compose exec $(app_container) bin/console cache:clear

migrations-generate: ## Создать пустую миграцию
	$(QUIET) docker-compose exec $(app_container) bin/console doctrine:migrations:generate

migrations-migrate: ## Выполнить миграции до последней версии
	$(QUIET) docker-compose exec $(app_container) bin/console doctrine:migrations:migrate

env-show: ## Показать переменные окружения
	$(QUIET) docker-compose exec $(app_container) bin/console debug:dotenv
	$(QUIET) docker-compose exec $(app_container) bin/console debug:container --env-vars

init-db: ## Проинициализировать БД
	$(QUIET) chmod 774 ./infrastructure/dev/postgrespro/bin/initdb.sh
	$(QUIET) ./infrastructure/dev/postgrespro/bin/initdb.sh

cmp-install: ## Установить пакеты
	$(QUIET) docker-compose run --rm --no-deps $(app_container) composer install

cmp-update: ## Обновить пакеты
	$(QUIET) docker-compose run --rm --no-deps $(app_container) composer update ${ARGS}

cmp-require: ## Добавить пакеты
	$(QUIET) docker-compose run --rm --no-deps $(app_container) composer require ${ARGS}

cmp-remove: ## Удалить пакеты
	$(QUIET) docker-compose run --rm --no-deps $(app_container) composer remove ${ARGS}

cmp-install-no-dev: ## Установить пакеты для рабочей среды
	$(QUIET) docker-compose run --rm --no-deps $(app_container) composer install --no-dev

cmp-recipes: ## Показать рецепты
	$(QUIET) docker-compose run --rm --no-deps $(app_container) composer recipes

cmp-details: ## Показать детали по конкретному рецепту
	$(QUIET) docker-compose run --rm --no-deps $(app_container) composer recipes ${ARGS}

cmp-update-rec: ## Установить обновление по конкретному рецепту
	$(QUIET) docker-compose run --rm --no-deps $(app_container) composer recipes:update ${ARGS}

shell-php: ## Войти в php-контейнер
	docker-compose run --rm --no-deps $(app_container) /bin/sh
