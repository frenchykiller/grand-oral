# Conteneur Apache-PHP générique

Ce conteneur permet l'exécution d'un conteneur Apache-PHP configurable via un fichier [.env](.env)

## Configuration

La configuration du conteneur se fait dans le fichier `.env`. Certaines modifications nécessitent un `rebuild` de l'image (voir dans le fichier `.env`), pour les autres un simple `make restart` suffira.

## Tâches cron

Pour ajouter ou éditer une tâche, éditer le fichier [conf/crontab](conf/crontab).

Pour que les tâches cron soient exécutées, définir `CRON_ENABLED` à `true` dans le fichier `.env` et lancer `make restart`.

## Récupération et mise à jour du registry

Au démarrage la dernière version de l'image est automatiquement récupérée.

Après une modification majeure, il est possible d'envoyer le build courant vers le registry avec `Make push`.

## Installation de laravel

Pour installer Laravel, lancer `Make laravel`.

Par défaut la version installée est la 6, pour installer une version supérieure (ou inférieure), lancer `Make laravel VERSION=...`.

## Makefile

```
start                Démarrage des conteneurs
stop                 Arrêt des conteneurs
restart              Redémarrage des conteneurs
status               Status des conteneurs
logs                 Affichage des logs des conteneurs
build                Build du conteneur
rebuild              Reconstruction et démarrage des conteneurs
pull                 Pull de la dernière version du conteneur
push                 Push du conteneur vers le registre
remove               Suppression des conteneurs
laravel              Installation de Laravel
```
