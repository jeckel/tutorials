.PHONY: build install demo clean

IMAGE_NAME=jeckel/tutorial-php-3

UID=$(shell id -u)
GID=$(shell id -g)

PHP_CMD=docker run --rm -u ${UID}:${GID} -v `pwd`:/project ${IMAGE_NAME}

build:
	@docker build -t ${IMAGE_NAME} .

install:
	@${PHP_CMD} composer install