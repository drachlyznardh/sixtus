
all: deploy
build: maps tags blog

PREFIX := /opt/devel/web/sixtus/
include $(PREFIX)deploy/vars.makefile
include $(PREFIX)deploy/maps.makefile

deploy: build
	@echo making pages
	@echo moving resources
	@echo moving system files

maps: $(DIRECT_MAP_FILE) $(REVERSE_MAP_FILE)

tags:
	@echo generating tags

blog:
	@echo generating blog pages

.PHONY: clean
clean: maps-clean
	@echo Cleaning
