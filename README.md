# Conteneur Apache-PHP générique

Ce conteneur permet l'exécution d'un conteneur Apache-PHP configurable via un fichier [.env](.env)

## Configuration

**NB** : à chaque changement de configuration, il est nécessaire de rebuilder le conteneur. Pour cela utiliser `make rebuild` ou `make remove && make start`

L'activation des extensions PHP se fait dans le fichier [.env](.env). Il suffit de passer les paramètres à `true` et builder (ou rebuilder) le conteneur. Idem pour définir si composer et nodejs/npm doivent être installés.

Pour la configuration de PHP, éditer le fichier [build/apache/php.ini](build/apache/php.ini)

Pour la configuration d'Apache, éditer le fichier [build/apache/vhost.conf](build/apache/vhost.conf)

## Tâches cron

Pour activer les tâches cron, décommentez les lignes du conteneur dans le fichier `docker-compose.yml`.

Pour ajouter une tâche, éditer le fichier [build/cron/crontab](build/cron/crontab). Par défaut, le conteneur appelle `php artisan schedule:run` dans le conteneur web.

**NB** : à chaque changement du fichier `crontab`, il est nécessaire de rebuilder le conteneur. Pour cela utiliser `make rebuild` ou `make remove && make start`


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
