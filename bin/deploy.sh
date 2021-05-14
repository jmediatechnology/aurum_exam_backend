#!/usr/bin/env sh

docker-compose down
docker-compose up -d --build
docker-compose exec php sh -c 'rm -rf var/'
docker-compose exec php sh -c 'composer install --no-interaction --optimize-autoloader'
docker-compose exec php sh -c 'bin/console assets:install --no-interaction'
docker-compose exec php sh -c 'sleep 10'
docker-compose exec php sh -c 'bin/console doctrine:database:drop --force'
docker-compose exec php sh -c 'bin/console doctrine:database:create'
docker-compose exec php sh -c 'bin/console doctrine:schema:create'
#docker-compose exec php sh -c 'bin/console doctrine:migrations:migrate --allow-no-migration --no-interaction'
docker-compose exec php sh -c 'bin/console doctrine:fixtures:load --no-interaction'
docker-compose exec php sh -c 'bin/console cache:clear'
