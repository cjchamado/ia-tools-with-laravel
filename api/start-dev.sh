#!/usr/bin/env bash

composer install

/usr/bin/supervisord -n -c /etc/supervisor/conf.d/supervisord.conf
