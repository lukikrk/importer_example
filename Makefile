DE=docker exec -it -u www-data importer_example

application:
	make install --no-print-directory
	@$(DE) make 2>&1 > /dev/null

########################################################################################################################

analyse:
	$(DE) php ./vendor/bin/php-cs-fixer fix --allow-risky=yes --dry-run --verbose
	$(DE) php ./vendor/bin/phpstan analyse
	$(DE) php ./vendor/bin/phpmd src,tests,public/index.php text phpmd.xml --color -vvv
	$(DE) php ./vendor/bin/psalm --no-cache

bash:
	@$(DE) bash

cli-docs:
	@$(DE) php bin/console

down:
	docker compose down

fix:
	$(DE) php ./vendor/bin/php-cs-fixer fix --allow-risky=yes

install:
	[ -f .env ] || cp .env.dist .env
	docker compose up -d --build

logs:
	docker logs -f importer_example

root:
	@echo '🕷 With great power comes great responsibility! 🕷'
	@docker exec -u root -it importer_example bash

stop:
	docker compose stop

test:
	$(DE) bin/console c:c --env=test
	$(DE) bin/console c:w --env=test
	$(DE) ./bin/phpunit

up:
	docker compose up -d
	@$(DE) make 2>&1 > /dev/null

xoff:
	docker exec importer_example xoff

xon:
	docker exec importer_example xon
