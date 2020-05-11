#!/bin/bash

if [ "${CRON_ENABLED}" = "true" ]; then
    crontab -l -u www-data | cat - /var/www/conf/crontab | crontab -u www-data -
    cron -f
fi
