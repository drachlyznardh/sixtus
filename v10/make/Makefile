
export SIXTUS_DIR := /opt/devel/web/sixtus/v10/
export SCRIPT_DIR := $(SIXTUS_DIR)script/
export MAKE_DIR   := $(SIXTUS_DIR)make/

export MAP_FILE := $(SOURCE_DIR)map.txt
export PAG_DIR  := $(SOURCE_DIR)src/

export BLOG_IN_DIR    := $(SOURCE_DIR)blog/
export BLOG_OUT_DIR   := $(PAG_DIR)Blog/

.PHONY: sixtus-blog sixtus-pages sixtus-runtime
sixtus-deploy: sixtus-pages sixtus-runtime

MAKE_RUNTIME := $(MAKE_DIR)sixtus-runtime.Makefile

sixtus-runtime:
	@$(MAKE) -f $(MAKE_RUNTIME)

include $(MAKE_DIR)sixtus-blog.Makefile
include $(MAKE_DIR)sixtus-pages.Makefile

.PHONY: clean
.PHONY: sixtus-runtime-clean sixtus-pages-clean sixtus-blog-clean
clean: sixtus-runtime-clean sixtus-pages-clean sixtus-blog-clean
	@rm -f $(BLOG_PAG_FILES)
	@rm -rf $(BUILD_DIR)
	@rm -f $(PHP_FILES)

sixtus-runtime-clean:
	@$(MAKE) -f $(MAKE_RUNTIME) clean

