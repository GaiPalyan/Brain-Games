install:
	composer install
play:
	php ./bin/play.php $(game)
lint:
	composer run-script phpcs -- --standard=PSR12 src bin tests
lint-fix:
	composer exec --verbose phpcbf -- --standard=PSR12 src bin tests
test:
	composer exec --verbose phpunit tests