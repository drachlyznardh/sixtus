
SIXTUS_DIR := /opt/devel/web/sixtus/v10/
SCRIPT_DIR := $(SIXTUS_DIR)script/
MAKE_DIR   := $(SIXTUS_DIR)make/

MAP_FILE := $(SOURCE_DIR)map.txt
PAG_DIR  := $(SOURCE_DIR)src/

BLOG_IN_DIR    := $(SOURCE_DIR)blog/
BLOG_OUT_DIR   := $(PAG_DIR)Blog/

.PHONY: sixtus-blog sixtus-pages sixtus-runtime
.PHONY: clean
sixtus-deploy: sixtus-pages sixtus-runtime

include $(MAKE_DIR)sixtus-blog.Makefile
include $(MAKE_DIR)sixtus-pages.Makefile
include $(MAKE_DIR)sixtus-runtime.Makefile

clean: sixtus-runtime-clean sixtus-pages-clean sixtus-blog-clean
	@rm -f $(BLOG_PAG_FILES)
	@rm -rf $(BUILD_DIR)
	@rm -f $(PHP_FILES)
