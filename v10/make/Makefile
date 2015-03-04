
export SIXTUS_DIR := /opt/devel/web/sixtus/v10/
export SCRIPT_DIR := $(SIXTUS_DIR)script/
export MAKE_DIR   := $(SIXTUS_DIR)make/

export MAP_FILE := $(SOURCE_DIR)map.txt
export PAG_DIR  := $(SOURCE_DIR)src/

export BLOG_IN_DIR    := $(SOURCE_DIR)blog/
export BLOG_OUT_DIR   := $(PAG_DIR)Blog/

.PHONY: sixtus-blog sixtus-pages sixtus-runtime
sixtus-deploy: sixtus-runtime sixtus-pages

MAKE_BLOG    := $(MAKE_DIR)sixtus-blog.Makefile
MAKE_RUNTIME := $(MAKE_DIR)sixtus-runtime.Makefile
MAKE_PAGES   := $(MAKE_DIR)sixtus-pages.Makefile

sixtus-blog:
	@$(MAKE) -f $(MAKE_BLOG) all

sixtus-runtime:
	@$(MAKE) -f $(MAKE_RUNTIME) all

sixtus-pages:
	@$(MAKE) -f $(MAKE_PAGES) all

.PHONY: clean veryclean
.PHONY: sixtus-runtime-clean sixtus-pages-clean sixtus-blog-clean
clean: sixtus-runtime-clean sixtus-pages-clean sixtus-blog-clean
	@echo All is clean

veryclean: clean
	@rm -rf $(DEPLOY_DIR)/*
	@echo All is very clean

sixtus-blog-clean:
	@$(MAKE) -f $(MAKE_BLOG) clean

sixtus-runtime-clean:
	@$(MAKE) -f $(MAKE_RUNTIME) clean

sixtus-pages-clean:
	@$(MAKE) -f $(MAKE_PAGES) clean
