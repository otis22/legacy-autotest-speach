default_php_version:=8.2
default_server_port:=8080
php_version:=$(PHP_VERSION)
server_port:=$(PORT)

ifndef PHP_VERSION
	php_version:=$(default_php_version)
endif

ifndef PORT
	server_port:=$(default_server_port)
endif

base_dir:=$(shell basename $(CURDIR))
docker:=docker run -u=$(shell id -u):$(shell id -g) --rm -v $(CURDIR):/app -w /app $(base_dir):$(php_version)

help:
	@echo ""
	@echo "usage: make COMMAND"
	@echo ""
	@echo "Commands:"
	@echo "  build                Build Docker"
	@echo "  serve                Run server php -S 0.0.0.0:8080"
	@echo "  exec                 Run shell in container"
	@echo "  exec_test            Run shell in e2e php-container"
	@echo "  install              Install composer dependencies with dev"
	@echo "  install-no-dev       Install composer dependencies without dev"
	@echo "  style                Check code style"
	@echo "  style-fix            Fix code style"
	@echo "  static-analyze       Check static analyze"
	@echo "  unit                 Run unit tests"
	@echo "  smoke                Run smoke tests"
	@echo "  integration          Run integration tests"
	@echo "  e2e                  Build compose and run e2e tests"
	@echo "  e2e-compose          Run e2e test compose"
	@echo "  coverage             Check test coverage"
	@echo "  all                  Run: build install style static-analyze unit integration smoke coverage"

build:
	docker build --build-arg VERSION=$(php_version) --tag $(base_dir):$(php_version) ./docker/
    docker pull selenoid/vnc_chrome:112.0

exec:
	docker run -u=$(shell id -u):$(shell id -g) --rm -ti -v $(CURDIR):/app:rw -w /app $(base_dir):$(php_version) sh

exec_test:
	docker compose -f ./docker-compose-testing.yml run php sh

serve:
	docker run -p$(server_port):8080 --rm -v $(CURDIR):/app -w /app $(base_dir):$(php_version) php -S 0.0.0.0:8080

install:
	$(docker) composer install

install-no-dev:
	$(docker) composer install --no-dev

style:
	$(docker) composer style

style-fix:
	$(docker) composer style-fix

static-analyze:
	$(docker) composer static-analyze

unit:
	$(docker) -dzend_extension=xdebug.so -dxdebug.mode=coverage  vendor/bin/phpunit --testsuite unit

integration:
	$(docker) -dzend_extension=xdebug.so -dxdebug.mode=coverage  vendor/bin/phpunit --testsuite integration

smoke:
	$(docker) -dzend_extension=xdebug.so -dxdebug.mode=coverage  vendor/bin/phpunit --testsuite smoke

e2e-compose:
	docker compose -f docker-compose-testing.yml build
	docker compose -f docker-compose-testing.yml up

coverage:
	$(docker) composer coverage

e2e: build install e2e-compose
all: build install style static-analyze unit integration smoke coverage

.PHONY: build