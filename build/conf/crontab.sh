#!/bin/bash

if [ -f /var/www/crontab ]; then
    crontab -l -u www-data | cat - /var/www/crontab | crontab -u www-data -
    cron -f
fi
