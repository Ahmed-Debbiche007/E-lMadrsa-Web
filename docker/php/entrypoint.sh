#!/bin/bash
composer update
echo "composer update"
php bin/console d:m:m
echo "running migrations" 
php bin/console doctrine:fixtures:load --append
echo "loading fixtures" 
symfony serve -d
echo "start server" 
php bin/console run:websocket-server
echo "running sockets"