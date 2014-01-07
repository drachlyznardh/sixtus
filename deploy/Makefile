
all: deploy
build: maps tags blog

include vars.makefile

deploy: build
	@echo making pages
	@echo moving resources
	@echo moving system files

maps: $(ACCESS_MAP_FILE) $(REVERSE_MAP_FILE)

tags:
	@echo generating tags

blog:
	@echo generating blog pages

.PHONY: clean
clean:
	@echo Cleaning
