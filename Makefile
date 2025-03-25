# vim: set tabstop=8 softtabstop=8 noexpandtab:
APP_ENV=test

.PHONY: help
help: ## Displays this list of targets with descriptions
	@grep -E '^[a-zA-Z0-9_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}'

.PHONY: cs
cs: vendor ## Normalizes composer.json with ergebnis/composer-normalize and fixes code style issues with friendsofphp/php-cs-fixer
	symfony composer normalize
	mkdir -p .build/php-cs-fixer
	PHP_CS_FIXER_IGNORE_ENV=1 symfony php vendor/bin/php-cs-fixer fix --config=.php-cs-fixer.dist.php --diff --verbose

.PHONY: tests
tests:
	export APP_ENV=test
	mkdir -p .build/phpunit
	symfony php vendor/bin/phpunit --configuration=phpunit.xml.dist --testdox

vendor: composer.json composer.lock
	symfony composer validate
	symfony composer install --no-interaction --no-progress --no-scripts
	@touch -mr $(shell ls -Atd $? | head -1) $@

.PHONY: dev
dev: vendor ## Starts the development server
	symfony server:start -d