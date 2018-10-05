.PHONY:help network start stop up down restart rebuild
.DEFAULT_GOAL=help

CYAN   = \033[0;36m
NC     = \033[m

-include .env

help:
	@grep -h -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-20s\033[0m %s\n", $$1, $$2}'

network:
	@docker network inspect proxy > /dev/null || docker network create proxy

start: network ## Démarrage des conteneurs
	@docker-compose up -d --remove-orphans

up: start

stop: ## Arrêt des conteneurs
	@docker-compose down

down: stop

restart: stop start ## Redémarrage des conteneurs

rebuild: network stop ## Reconstruction et démarrage des conteneurs
	@docker-compose up -d --build --force-recreate --remove-orphans
