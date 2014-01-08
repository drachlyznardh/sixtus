
all: deploy
build: maps tags blog

PREFIX := /opt/devel/web/sixtus/
include $(PREFIX)deploy/vars.makefile
include $(PREFIX)deploy/maps.makefile

deploy: build
	@echo making pages
	@echo moving resources
	@echo moving system files

maps: $(RUNTIME_CONF_FILE) $(DIRECT_MAP_FILE) $(REVERSE_MAP_FILE)

tags:
	@echo generating tags

blog:
	@echo "Generating blog pages"
	@$(MAKE) -f $(PREFIX)deploy/blog.makefile

.PHONY: clean
clean: maps-clean
	@echo Cleaning
	@$(MAKE) -f $(PREFIX)deploy/blog.makefile clean
