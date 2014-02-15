
all: deploy
build: maps tags

export PREFIX := /opt/devel/web/sixtus/
include $(PREFIX)deploy/vars.makefile
include $(PREFIX)deploy/maps.makefile

### Other makefiles
MAKE_RUNTIME   := $(MAKE) -f $(PREFIX)deploy/runtime.makefile
MAKE_RESOURCES := $(MAKE) -f $(PREFIX)deploy/resources.makefile
MAKE_BLOG      := $(MAKE) -f $(PREFIX)deploy/blog.makefile
MAKE_DB        := $(MAKE) -f $(PREFIX)deploy/db.makefile
MAKE_PAGES     := $(MAKE) -f $(PREFIX)deploy/pages.makefile
MAKE_PAGE      := $(MAKE) -f $(PREFIX)deploy/page.makefile
MAKE_FRAG      := $(MAKE) -f $(PREFIX)deploy/frag.makefile

deploy: build page
	@$(MAKE_RUNTIME)
	@$(MAKE_RESOURCES)

tags:
	@$(MAKE_DB)

frag:
	@$(MAKE_FRAG)

blog:
	@$(MAKE_BLOG)

page: frag #blog
	@$(MAKE_PAGE)

.PHONY: clean
clean: maps-clean
	@$(MAKE_BLOG) clean
	@$(MAKE_DB) clean
	@$(MAKE_RUNTIME) clean
	@$(MAKE_RESOURCES) clean
	@$(MAKE_PAGES) clean

