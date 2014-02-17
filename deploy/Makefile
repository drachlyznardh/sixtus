
export PREFIX := /opt/devel/web/sixtus/
include $(PREFIX)deploy/vars.makefile
include $(PREFIX)deploy/maps.makefile

### Other makefiles
MAKE_RUNTIME   := $(MAKE) $(QUIET) -f $(PREFIX)deploy/runtime.makefile
MAKE_RESOURCES := $(MAKE) $(QUIET) -f $(PREFIX)deploy/resources.makefile
MAKE_BLOG      := $(MAKE) $(QUIET) -f $(PREFIX)deploy/blog.makefile
MAKE_DB        := $(MAKE) $(QUIET) -f $(PREFIX)deploy/db.makefile
MAKE_PAGES     := $(MAKE) $(QUIET) -f $(PREFIX)deploy/pages.makefile
MAKE_PAGE      := $(MAKE) $(QUIET) -f $(PREFIX)deploy/page.makefile
MAKE_FRAG      := $(MAKE) $(QUIET) -f $(PREFIX)deploy/frag.makefile

build: map tag

deploy: build page runtime resources

runtime:
	@$(MAKE_RUNTIME)
	
runtime-clean:
	@$(MAKE_RUNTIME) clean
	
resources:
	@$(MAKE_RESOURCES)

resources-clean:
	@$(MAKE_RESOURCES) clean

frag:
	@$(MAKE_FRAG)

frag-clean:
	@$(MAKE_FRAG) clean

blog:
	@$(MAKE_BLOG)

blog-clean:
	@$(MAKE_BLOG) clean

page: frag
	@$(MAKE_PAGE)

page-clean:
	@$(MAKE_PAGE) clean

tag:
	@$(MAKE_DB)

tag-clean:
	@$(MAKE_DB) clean

.PHONY: clean, blog-clean, frag-clean, page-clean, resources-clean, runtime-clean, tag-clean
clean: map-clean frag-clean page-clean resources-clean runtime-clean tag-clean
	@rm -rf $(BUILD_DIR)

