# Php-fpm-alpine x Nginx
### Symfony | Docker

Avec MariaDB & MailDev

Pour lancer le projet :
````shell
docker-compose up -d
docker exec symfony_docker (cd html && bin/console doctrine:database:create)
docker exec symfony_docker (cd html && bin/console doctrine:migrations:migrate)
docker exec symfony_docker (cd html && bin/console doctrine:fixture:load)
docker exec symfony_docker (cd html && bin/console api:import-disney-data 100)
````


## Original api url
[GraphQL](https://api.disneyapi.dev/graphql)
