migrate:
	docker exec -it news_php_1 php yii migrate

migrate-test:
	docker exec -it news_php_1 php test/bin/yii migrate

test:
	docker exec -it news_php_1 ./phantomjs --webdriver=4444 &
	docker exec -it news_php_1 vendor/bin/codecept run

test_unit:
	docker exec -it news_php_1 vendor/bin/codecept run unit

test_functional:
	docker exec -it news_php_1 vendor/bin/codecept run functional

test_acceptance:
	docker exec -it news_php_1 ./phantomjs --webdriver=4444 &
	docker exec -it news_php_1 vendor/bin/codecept run acceptance
