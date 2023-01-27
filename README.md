# Disney API
A copy of [disneyapi.dev](https://disneyapi.dev/) with more endpoints build with Symfony, Docker and API Platform.

## Installation
````shell
docker-compose up -d
docker exec symfony_docker (cd html && bin/console doctrine:database:create)
docker exec symfony_docker (cd html && bin/console doctrine:migrations:migrate)
docker exec symfony_docker (cd html && bin/console doctrine:fixture:load)
docker exec symfony_docker (cd html && bin/console api:import-disney-data 100)
````

## Accounts
Admin account:
- login : admin@disney.com
- password : root
