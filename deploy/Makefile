
all: deploy
build: maps tags blog

export PREFIX := /opt/devel/web/sixtus/
include $(PREFIX)deploy/vars.makefile
include $(PREFIX)deploy/maps.makefile

### Other makefiles
MAKE_RUNTIME   := $(MAKE) -f $(PREFIX)deploy/runtime.makefile
MAKE_RESOURCES := $(MAKE) -f $(PREFIX)deploy/resources.makefile
MAKE_BLOG      := $(MAKE) -f $(PREFIX)deploy/blog.makefile
MAKE_DB        := $(MAKE) -f $(PREFIX)deploy/db.makefile
MAKE_PAGES     := $(MAKE) -f $(PREFIX)deploy/pages.makefile

deploy: build
	@$(MAKE_RUNTIME)
	@$(MAKE_RESOURCES)
	@$(MAKE_PAGES)

tags:
	@$(MAKE_DB)

blog:
	@$(MAKE_BLOG)

.PHONY: clean
clean: maps-clean
	@$(MAKE_BLOG) clean
	@$(MAKE_DB) clean
	@$(MAKE_RUNTIME) clean
	@$(MAKE_RESOURCES) clean
	@$(MAKE_PAGES) clean

