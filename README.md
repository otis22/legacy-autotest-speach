# Проект для Доклада в Краснодаре в декабре 2023

composer require --dev phpunit/phpunit
mkdir tests
./vendor/bin/phpunit --generate-configuration
composer require php-webdriver/webdriver


docker compose -f docker-compose-testing.yml up

docker exec -it speach-php sh