sync:
	@echo "Syncing with remote main branch..."
	@git checkout main
	@git pull origin main
	@echo "Latest logs:"
	@git log -1

analyse:
	@./vendor/bin/phpstan analyse -c phpstan.neon --memory-limit=1G

.PHONY: sync analyse
