.PHONY: install

UID=$(shell id -u)
GID=$(shell id -g)

install:
	@docker-compose run --no-deps --rm -u ${UID}:${GID} php composer install