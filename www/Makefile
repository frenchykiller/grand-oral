.PHONY:help network start stop up down restart rebuild
.DEFAULT_GOAL=help

CYAN   = \033[0;36m
NC     = \033[m

ENV ?= dev
NPM_ENV ?= dev
COMPOSER_OPTS=
ifeq ($(ENV), preprod)
COMPOSER_OPTS=--no-dev --optimize-autoloader --prefer-dist --no-suggest --no-progress
NPM_ENV = prod
endif
ifeq ($(ENV), prod)
COMPOSER_OPTS=--no-dev --optimize-autoloader --prefer-dist --no-suggest --no-progress
NPM_ENV = prod
endif

help:
	@grep -h -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-20s\033[0m %s\n", $$1, $$2}'

install: .env vendor migrations ## Installation du projet
	@if [ $(ENV) = "dev" ]; then php artisan ide-helper:models -N && php artisan ide-helper:meta && php artisan ide-helper:generate; fi
	php artisan db:seed --force
	php artisan storage:link

update: vendor migrations ## Mise à jour du projet
	if [ "$(ENV)" = "dev" ]; then php artisan ide-helper:models -N && php artisan ide-helper:meta && php artisan ide-helper:generate; fi
	if [ "$(ENV)" != "dev" ]; then php artisan config:cache && php artisan route:cache; fi
	php artisan up

vendor: composer.lock
	php artisan cache:clear -n
	composer install $(COMPOSER_OPTS)

composer.lock: composer.json
	php artisan cache:clear -n
	composer install $(COMPOSER_OPTS)

node_modules: package-lock.json
	npm ci

package-lock.json: package.json
	npm ci

.env:
	@if [ $(ENV) = 'dev' ]; then ln -s .env.$(ENV) .env && php artisan key:generate; fi
	@[ -f .env ] || echo "Créez le fichier .env et configurez le avant de relancer make install ENV=$(ENV)"

migrations: .env
	@[ ! -f .env ] || php artisan migrate --force

down:
	@php artisan down --render="errors::maint" --secret="1630542a-246b-4b66-afa1-dd72a4c43515"

up:
	@php artisan up


websocket: ## Lancement du serveur websocket
	@if [ -f .env ]; then \
		if ! (ps -aux | grep -v grep | grep --quiet 'boilerplate:websocket'); then \
			echo "Lancement du serveur websocket"; \
			nohup php artisan boilerplate:websocket > /dev/null 2>&1 & \
		fi; \
	fi;

websocketstop: ## Arrêt du serveur websocket
	@if (ps -aux | grep -v grep | grep --quiet 'boilerplate:websocket'); then \
		echo "Arrêt du serveur websocket"; \
		pkill -f "php artisan boilerplate:websocket"; \
	fi;
