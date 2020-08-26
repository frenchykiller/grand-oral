.PHONY:help network bash bashroot start up stop down restart status logs build rebuild pull push remove
.DEFAULT_GOAL=help

CYAN   = \033[0;36m
NC     = \033[m
ENV   ?= dev
VERSION ?= ^7

ARCH := $(shell uname -m)
export ARCH

UID := $(shell id -u)
export UID

-include .env

help:
	@grep -h -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-20s\033[0m %s\n", $$1, $$2}'

.env:
	@[ -f .env ] || ln -s .env.$(ENV) .env

network:
	@docker network inspect proxy > /dev/null || docker network create proxy

bash: ## Accéder au conteneur en bash
	@docker-compose exec -u www-data web bash

bashroot: ## Accéder au conteneur en bash en root
	@docker-compose exec web bash

start: www network .env ## Démarrage des conteneurs
	@docker-compose up -d --remove-orphans

up: start

stop: ## Arrêt des conteneurs
	@docker-compose down --remove-orphans

down: stop

restart: stop start ## Redémarrage des conteneurs

status: ## Status des conteneurs
	@docker-compose ps

logs: ## Affichage des logs des conteneurs
	@docker-compose logs --follow web

build: .env ## Build du conteneur
	@docker-compose build --compress web

build-no-cache: .env
	@docker-compose build --no-cache --compress web
	
rebuild: network stop remove build-no-cache start ## Reconstruction et démarrage des conteneurs

pull: .env ## Pull de la dernière version du conteneur
	@docker-compose pull web

push: .env ## Push du conteneur vers le registre
	@docker-compose push web
	
remove: ## Suppression des conteneurs
	@docker-compose down --rmi all -v --remove-orphans

laravel: start ## Installation de Laravel
	@docker-compose exec -T -u www-data web bash -c "composer create-project --prefer-dist laravel/laravel . $(VERSION)"
	
www:
	@[ -d www/$(PUBLIC_FOLDER) ] || mkdir -p www/$(PUBLIC_FOLDER)
