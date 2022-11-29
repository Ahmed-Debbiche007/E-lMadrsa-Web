#!/bin/bash


sleep 15

for file in ./migrations/*.php
do
    if [ -f "${file}" ]; then
    php bin/console doctrine:migrations:diff &> migrations.txt;
    break
    else
    php bin/console migrations:migrate
    fi
done

if grep -q "No changes" migrations.txt; then
echo "Already migrated!"
sleep 1
echo "Fixtures already loaded!"
else 
echo "Running migrations"
php bin/console d:m:m 
echo "loading fixtures" 
php bin/console doctrine:fixtures:load --append
fi


symfony serve -d
echo "start server" 
php bin/console run:websocket-server
echo "running sockets"