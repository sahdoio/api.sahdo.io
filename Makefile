# Variables
DC=USERID=$(USERID) GROUPID=$(GROUPID) docker compose --file docker-compose.yml --env-file ./src/.env

.PHONY: up down sh logs setup test migrate rollback horizon app-log

USERID := $(shell id -u)
GROUPID := $(shell id -g)

show-vars:
	@echo "USERID: $(USERID)"
	@echo "GROUPID: $(GROUPID)"

go: stop
	$(DC) run sahdo-api composer install
	$(DC) up -d --build

stop:
	$(DC) down

sh:
	$(DC) exec sahdo-api sh

test:
	$(DC) exec sahdo-api composer test

test-report:
	$(DC) exec sahdo-api vendor/bin/pest --coverage-html=report

logs:
	$(DC) logs -f --tail=10

migrate:
	$(DC) exec sahdo-api php artisan migrate

rollback:
	$(DC) exec sahdo-api php artisan migrate:rollback

horizon:
	$(DC) exec sahdo-api php artisan horizon

app-log:
	$(DC) exec sahdo-api tail -f storage/logs/laravel.log -n 0
