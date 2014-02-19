
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

sixtus-build: sixtus-map sixtus-tag

sixtus-deploy: sixtus-build sixtus-page sixtus-runtime sixtus-resources

sixtus-runtime:
	@$(MAKE_RUNTIME)
	
sixtus-runtime-clean:
	@$(MAKE_RUNTIME) clean
	
sixtus-resources:
	@$(MAKE_RESOURCES)

sixtus-resources-clean:
	@$(MAKE_RESOURCES) clean

sixtus-frag:
	@$(MAKE_FRAG)

sixtus-frag-clean:
	@$(MAKE_FRAG) clean

sixtus-blog:
	@$(MAKE_BLOG)

sixtus-blog-clean:
	@$(MAKE_BLOG) clean

sixtus-page: sixtus-frag
	@$(MAKE_PAGE)

sixtus-page-clean:
	@$(MAKE_PAGE) clean

sixtus-tag:
	@$(MAKE_DB)

sixtus-tag-clean:
	@$(MAKE_DB) clean

.PHONY: sixtus-blog-clean, sixtus-frag-clean, sixtus-page-clean
sixtus-clean: sixtus-map-clean sixtus-frag-clean sixtus-page-clean

.PHONY: sixtus-resources-clean, sixtus-runtime-clean, sixtus-tag-clean
sixtus-clean: sixtus-resources-clean sixtus-runtime-clean sixtus-tag-clean

.PHONY: sixtus-clean
sixtus-clean: 
	@rm -rf $(BUILD_DIR)

