#!/bin/bash

docker-compose up -d grafana-storage

until docker-compose exec grafana-storage sh -c "pg_isready" > /dev/null
do
    printf '.'
done
printf '\n'

docker-compose up