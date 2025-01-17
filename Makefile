.PHONY: help ps build build-prod start fresh fresh-prod stop restart destroy \
	cache cache-clear migrate migrate migrate-fresh tests tests-html

help: ## Print help.
	@awk 'BEGIN {FS = ":.*##"; printf "\nUsage:\n  make \033[36m<target>\033[0m\n\nTargets:\n"} /^[a-zA-Z_-]+:.*?##/ { printf "  \033[36m%-10s\033[0m %s\n", $$1, $$2 }' $(MAKEFILE_LIST)

ps: ## Show containers.
	@./vendor/bin/sail ps

first-build: ## Initial build after clone
	cp .env.example .env
	@docker run --rm \
		-u "$(id -u):$(id -g)" \
		-v "$$(pwd):/var/www/html" \
		-w /var/www/html \
		laravelsail/php84-composer:latest \
		composer install --ignore-platform-reqs
	@./vendor/bin/sail up -d
	@./vendor/bin/sail php artisan key:generate
	@./vendor/bin/sail php artisan migrate:fresh --seed
	@./vendor/bin/sail npm install
	@./vendor/bin/sail npm run dev

build: ## Start all containers
	@./vendor/bin/sail build --no-cache

up: ## Start all containers
	@./vendor/bin/sail up -d

stop: ## Stop all containers
	@./vendor/bin/sail stop

down: ## Down all containers
	@./vendor/bin/sail down -v

force-up: ## Force start all containers
	@./vendor/bin/sail up --force-recreate -d

npm-dev: ## Compile assets locally
	@./vendor/bin/sail npm run dev

migrate: ## Database migrate
	@./vendor/bin/sail php artisan migrate

migrate-fresh: ## Fresh Database migrate
	@./vendor/bin/sail php artisan migrate:fresh --seed

start: up npm-dev ## Start project

composer-install: ## Composer install
	@./vendor/bin/sail composer install

composer-dump: ## Composer dump autoload
	@./vendor/bin/sail composer dump-autoload

composer-update: ## Composer update
	@./vendor/bin/sail composer update

