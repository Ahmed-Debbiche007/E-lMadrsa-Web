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

npm install
npm run build

symfony serve -d
echo "start server" 
php bin/console run:websocket-server
echo "running sockets"