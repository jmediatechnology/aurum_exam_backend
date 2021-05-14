#!/usr/bin/env sh

bin/console doctrine:database:drop --force
bin/console doctrine:database:create
bin/console doctrine:schema:create
bin/console doctrine:fixtures:load --no-interaction
bin/console cache:clear
