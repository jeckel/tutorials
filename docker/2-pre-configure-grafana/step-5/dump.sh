#!/bin/bash

docker-compose exec grafana-storage sh -c "pg_dump -U admin grafana > /var/export/dbexport.sql"