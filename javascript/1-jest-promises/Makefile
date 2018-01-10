.PHONY: install test

# Define NPM command line
NPM_CMD:=docker run --rm -it -v `pwd`:/app --workdir /app node:8-alpine npm

install:
	@${NPM_CMD} install

#npm:
#	@${NPM_CMD} ${CMD}

test:
	@${NPM_CMD} test