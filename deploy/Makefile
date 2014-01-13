
all: deploy
build: maps tags blog

export PREFIX := /opt/devel/web/sixtus/
include $(PREFIX)deploy/vars.makefile
include $(PREFIX)deploy/maps.makefile

### Other makefiles
MAKE_RUNTIME   := $(MAKE) -f $(PREFIX)deploy/runtime.makefile
MAKE_RESOURCES := $(MAKE) -f $(PREFIX)deploy/resources.makefile
MAKE_PAGES     := $(MAKE) -f $(PREFIX)deploy/pages.makefile

deploy: build
	@$(MAKE_RUNTIME)
	@$(MAKE_RESOURCES)
	@$(MAKE_PAGES)

maps: $(RUNTIME_CONF_FILE) $(DIRECT_MAP_FILE) $(REVERSE_MAP_FILE)

tags:
	@echo generating tags

blog:
	@$(MAKE) -f $(PREFIX)deploy/blog.makefile

.PHONY: clean
clean: maps-clean
	@echo Cleaning
	@$(MAKE) -f $(PREFIX)deploy/blog.makefile clean
	@$(MAKE_RUNTIME) clean
	@$(MAKE_RESOURCES) clean
	@$(MAKE_PAGES) clean

