# Colorations des messages
GREEN = /bin/echo -e "\x1b[32m\#\# $1\x1b[0m"
RED = /bin/echo -e "\x1b[31m\#\# $1\x1b[0m"

# Variables globales
CONTAINER_PROJECT = www_ctas
D = docker
DC = docker-compose
RUN_DOCKER_CONTAINER = $(D) exec  -it  $(CONTAINER_PROJECT) bash
EXEC = $(D) exec -w /var/www/project $(CONTAINER_PROJECT)
PHP = $(EXEC) php
C = $(EXEC) composer
NPM = $(EXEC) npm
SFC = $(PHP) bin/console


## —— 🔥 Inisialization of application ——
init: ## Init the project
	$(MAKE) start
	$(MAKE) composer-install
	$(MAKE) npm-install
	@$(call GREEN,"The application is available at: http://127.0.0.1:8080/.")


## —— ✅ Docker CMD ——
cctas: ## Symfony CMD php bin/console
	$(RUN_DOCKER_CONTAINER)

## —— ✅ Tests ——
.PHONY: tests
tests: ## Run all tests
	$(MAKE) database-init-test
	$(PHP) bin/phpunit --testdox tests/Unit/
	$(PHP) bin/phpunit --testdox tests/Functional/
	$(PHP) bin/phpunit --testdox tests/E2E/

db-init-test: ## Init database for test
	$(SFC) d:d:d --force --if-exists --env=test
	$(SFC) d:d:c --env=test
	$(SFC) d:m:m --no-interaction --env=test
	$(SFC) d:f:l --no-interaction --env=test

unit-test: ## Run unit tests
	$(MAKE) database-init-test
	$(PHP) bin/phpunit --testdox tests/Unit/

functional-test: ## Run functional tests
	$(MAKE) database-init-test
	$(PHP) bin/phpunit --testdox tests/Functional/

# PANTHER_NO_HEADLESS=1 ./bin/phpunit --filter LikeTest --debug to debug with Chrome
e2e-test: ## Run E2E tests
	$(MAKE) database-init-test
	$(PHP) bin/phpunit --testdox tests/E2E/

## —— 🐳 Docker ——
start: ## Start app
	$(MAKE) docker-start
docker-start:
	$(DC) up -d

stop: ## Stop app
	$(MAKE) docker-stop
docker-stop:
	$(DC) stop
	@$(call RED,"The containers are now stopped.")

## —— 🎻 Composer ——
composer-install: ## Install dependencies
	$(C) install

composer-update: ## Update dependencies
	$(C) update

## —— 🐈 NPM —————————————————————————————————————————————————————————————————
npm-install: ## Install all npm dependencies
	$(NPM) install

npm-update: ## Update all npm dependencies
	$(NPM) update

npm-watch: ## Update all npm dependencies
	$(NPM) run watch

## —— 📊 Database ——
database-init: ## Init database
	$(MAKE) database-drop
	$(MAKE) database-create
	$(MAKE) database-migrate
	$(MAKE) database-fixtures-load

database-drop: ## Create database
	$(SFC) d:d:d --force --if-exists

database-create: ## Create database
	$(SFC) d:d:c --if-not-exists

database-remove: ## Drop database
	$(SFC) d:d:d --force --if-exists

database-migration: ## Make migration
	$(SFC) make:migration

migration: ## Alias : database-migration
	$(MAKE) database-migration

database-migrate: ## Migrate migrations
	$(SFC) d:m:m --no-interaction


migrate: ## Alias : database-migrate
	$(MAKE) database-migrate

database-fixtures-load: ## Load fixtures
	$(SFC) d:f:l --no-interaction

fixtures: ## Alias : database-fixtures-load
	$(MAKE) database-fixtures-load

## —— 🛠️  Others ——
help: ## List of commands
	@grep -E '(^[a-zA-Z0-9_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}{printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'



install-yarn:
	$(NPM) install -g yarn


