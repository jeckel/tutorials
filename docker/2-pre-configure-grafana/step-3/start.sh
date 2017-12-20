#!/bin/bash

docker-compose up -d grafana-storage

while :
do
    docker-compose exec grafana-storage sh -c "pg_isready" > /dev/null
    if [ $? -eq 0 ]
    then
        printf ' Ready\n'
        break
    fi
    printf '.'
    sleep 1
done
docker-compose up