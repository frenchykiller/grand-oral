.PHONY:help network bash bashroot start up stop down restart status logs build rebuild pull push remove
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

start: network .env pull ## Démarrage des conteneurs
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

build: .env ## Build du conteneur
	@docker-compose build --compress --force-rm --no-cache web
	
rebuild: network stop ## Reconstruction et démarrage des conteneurs
	@docker-compose up -d --build --force-recreate --remove-orphans

pull: .env ## Pull de la dernière version du conteneur
	@docker-compose pull web

push: .env ## Push du conteneur vers le registre
	@docker-compose push web
	
remove: ## Suppression des conteneurs
	@docker-compose down --rmi all -v --remove-orphans
