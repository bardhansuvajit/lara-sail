.PHONY: help ps build build-prod start fresh fresh-prod stop restart destroy \
	cache cache-clear migrate migrate migrate-fresh tests tests-html

help: ## Print help.
	@awk 'BEGIN {FS = ":.*##"; printf "\nUsage:\n  make \033[36m<target>\033[0m\n\nTargets:\n"} /^[a-zA-Z_-]+:.*?##/ { printf "  \033[36m%-10s\033[0m %s\n", $$1, $$2 }' $(MAKEFILE_LIST)

ps: ## Show containers.
	@./vendor/bin/sail ps

build: ## Start all containers
	@./vendor/bin/sail build --no-cache

up: ## Start all containers
	@./vendor/bin/sail up -d

force-up: ## Force start all containers
	@./vendor/bin/sail up --force-recreate -d

n-dev: ## Compile assets locally
	@./vendor/bin/sail npm run dev