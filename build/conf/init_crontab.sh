#!/bin/bash

if [ "${CRON_ENABLED}" = "true" ]; then
    if [ ! -f /var/spool/cron/crontabs/www-data ]; then
        crontab -l -u www-data | cat - /var/www/conf/crontab | crontab -u www-data -    
        chown ${UID}:crontab /var/spool/cron/crontabs/www-data    
    else
        cron -f
    fi
fi
