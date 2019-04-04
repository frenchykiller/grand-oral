.PHONY:help network start stop up down restart rebuild
.DEFAULT_GOAL=help

CYAN   = \033[0;36m
NC     = \033[m
ENV   ?= dev

-include .env

help:
	@grep -h -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-20s\033[0m %s\n", $$1, $$2}'

.env:
	@[ -f .env ] || ln -s .env.$(ENV) .env && mkdir -p www/$(PUBLIC_FOLDER)

network:
	@docker network inspect proxy > /dev/null || docker network create proxy

bash:
	@docker-compose exec -u www-data web bash

bashroot:
	@docker-compose exec web bash

start: network .env ## Démarrage des conteneurs
	@docker-compose up -d --remove-orphans

up: start

stop: ## Arrêt des conteneurs
	@docker-compose down --remove-orphans

down: stop

restart: stop start ## Redémarrage des conteneurs

status: ## Status des conteneurs
	@docker-compose ps

logs: ## Affichage des logs des conteneurs
	@docker-compose logs

rebuild: network stop ## Reconstruction et démarrage des conteneurs
	@docker-compose up -d --build --force-recreate --remove-orphans

remove: ## Suppression des conteneurs
	@docker-compose down --rmi all -v --remove-orphans
