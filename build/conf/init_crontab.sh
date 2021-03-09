#!/bin/bash

if [ "${CRON_ENABLED}" = "true" ]; then
    crontab -l -u www-data | cat - /var/www/conf/crontab | crontab -u www-data -    
    chown ${UID}:crontab /var/spool/cron/crontabs/www-data
    cron -f
fi