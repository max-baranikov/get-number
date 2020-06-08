#!/usr/bin/env bash

# At start we pull changes from repository
git pull

# install dependencies if needed
composer install --prefer-dist --no-scripts

# then wait for database connection and update migrations
./healthprobe.sh -- "php bin/console doctrine:query:sql 'SHOW DATABASES'" && bin/console doctrine:database:create --if-not-exists && bin/console doctrine:migrations:migrate -n

# and run parent init script
/sbin/upstart