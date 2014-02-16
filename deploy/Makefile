
all: deploy
build: map tag

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

frag:
	@$(MAKE_FRAG)

frag-clean:
	@$(MAKE_FRAG) clean

blog:
	@$(MAKE_BLOG)

blog-clean:
	@$(MAKE_BLOG) clean

page: frag #blog
	@$(MAKE_PAGE)

page-clean:
	@$(MAKE_PAGE) clean

tag:
	@$(MAKE_DB)

tag-clean:
	@$(MAKE_DB) clean

.PHONY: clean, blog-clean, frag-clean, page-clean, tag-clean
clean: map-clean frag-clean page-clean tag-clean
	@$(MAKE_RUNTIME) clean
	@$(MAKE_RESOURCES) clean

