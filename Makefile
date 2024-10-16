sync:
	@echo "Syncing with remote main branch..."
	@git checkout main
	@git pull origin main
	@echo "Latest logs:"
	@git log -1

analyse:
	@./vendor/bin/phpstan analyse -c phpstan.neon --memory-limit=1G

seed:
	@php artisan migrate:fresh --seed

todo:
	@echo "Searching for TODO comments in the codebase..."
	@grep -rni --exclude-dir=vendor --exclude-dir=node_modules --exclude-dir=storage --exclude=Makefile "// todo" ./
	@echo "Search Completed!"

ide-model:
	@php artisan ide-helper:model --write

test:
	@php artisan test --parallel --stop-on-failure tests/Feature

freelog:
	@echo "" > ./storage/logs/laravel.log

.PHONY: sync analyse seed todo ide-model test freelog
