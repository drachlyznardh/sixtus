
SIXTUS_DIR := /opt/devel/web/sixtus/v10/
SCRIPT_DIR := $(SIXTUS_DIR)script/
MAKE_DIR   := $(SIXTUS_DIR)make/

MAP_FILE := $(SOURCE_DIR)map.txt
PAG_DIR  := $(SOURCE_DIR)src/
BLOG_DIR := $(SOURCE_DIR)blog/

.PHONY: sixtus-runtime sixtus-pages
.PHONY: clean

include $(MAKE_DIR)sixtus-runtime.Makefile
include $(MAKE_DIR)sixtus-pages.Makefile

POST_FILES := $(sort $(shell find $(BLOG_DIR) -name '*.post'))
POST_YEARS := $(patsubst $(BLOG_DIR)%/, %, $(dir $(POST_FILES)))

sixtus-blog:
	@echo Blog is ready
	@echo $(POST_FILES)
	@echo $(POST_YEARS)
