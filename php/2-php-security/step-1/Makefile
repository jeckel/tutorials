.PHONY: build install demo clean

UID=$(shell id -u)
GID=$(shell id -g)

COMPOSER_CMD=docker-compose run --no-deps --rm -u ${UID}:${GID} php composer

build:
	@docker-compose build

install: build
	@${COMPOSER_CMD} install

demo:
	docker-compose run --rm php && docker-compose stop

clean:
	@docker-compose down -v
