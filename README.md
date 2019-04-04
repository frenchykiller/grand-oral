# Conteneur Apache-PHP générique

Ce conteneur permet l'exécution d'un conteneur Apache-PHP configurable via un fichier [.env](.env)

## Configuration

**NB** : à chaque changement de configuration, il est nécessaire de rebuilder le conteneur. Pour cela utiliser `make rebuild`.

L'activation des extensions PHP se fait dans le fichier [.env](.env). Il suffit de passer les paramètres à `true` et builder (ou rebuilder) le conteneur. Idem pour définir si composer et nodejs/npm doivent être installés.

## Tâches cron

Pour ajouter ou éditer une tâche, éditer le fichier [build/crontab](build/crontab) et lancer `make rebuild`

## Makefile

```
start                Démarrage des conteneurs
stop                 Arrêt des conteneurs
restart              Redémarrage des conteneurs
status               Status des conteneurs
logs                 Affichage des logs des conteneurs
rebuild              Reconstruction et démarrage des conteneurs
remove               Suppression des conteneurs
```
