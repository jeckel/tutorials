.PHONY: install demo clean

UID=$(shell id -u)
GID=$(shell id -g)

install:
	@docker-compose run --no-deps --rm -u ${UID}:${GID} php composer install

demo:
	@docker-compose up -d mysql && docker-compose up php && docker-compose stop

clean:
	@docker-compose down -v