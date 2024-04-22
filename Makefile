up:
	docker-compose up -d

build:
	docker-compose exec node yarn build

php:
	pvm use 8.3.4

node:
	nvm use 18.16.0

target1:
	docker build --target=node_build --tag=crew:0.0.1 -f ./docker/node/Dockerfile .
