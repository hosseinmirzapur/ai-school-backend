sync:
	@echo "Syncing with remote main branch..."
	@git checkout main
	@git pull origin main
	@echo "Latest logs:"
	@git log -1

.PHONY: sync
