#!/bin/bash

docker-compose up -d grafana-storage && \
    sleep 5 && \
    docker-compose up