.PHONY: up run in stop clean build

build:
	docker-compose build

up:
	docker-compose up -d

in:
	docker exec -it -w /var/www/chatbot/src/ chatbot-php /bin/bash

stop:
	docker-compose stop

clean:
	docker-compose down --remove-orphans