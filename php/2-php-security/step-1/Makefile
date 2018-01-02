.PHONY: build install demo clean

UID=$(shell id -u)
GID=$(shell id -g)

build:
	@docker-compose build

install: build
	@docker-compose run --no-deps --rm -u ${UID}:${GID} php composer install

demo:
	docker-compose run --rm php && docker-compose stop
#	@docker-compose up -d mysql && \
#		sleep 10 && \
#		docker-compose run --rm php && \
#		docker-compose stop

clean:
	@docker-compose down -v
