
SIXTUS_DIR := /opt/devel/web/sixtus/v10/
SCRIPT_DIR := $(SIXTUS_DIR)script/
MAKE_DIR   := $(SIXTUS_DIR)make/

MAP_FILE := $(SOURCE_DIR)map.txt
PAG_DIR  := $(SOURCE_DIR)src/

BLOG_IN_DIR    := $(SOURCE_DIR)blog/
BLOG_OUT_DIR   := $(PAG_DIR)Blog/

.PHONY: sixtus-runtime sixtus-pages
.PHONY: clean

include $(MAKE_DIR)sixtus-runtime.Makefile
include $(MAKE_DIR)sixtus-pages.Makefile

POST_FILES  := $(sort $(shell find $(BLOG_IN_DIR) -name '*.post'))
POST_MONTHS := $(sort $(patsubst $(BLOG_IN_DIR)%.post, %, $(POST_FILES)))
POST_YEARS  := $(sort $(patsubst $(BLOG_IN_DIR)%/, %, $(dir $(POST_FILES))))
POST_MAP    := $(BUILD_DIR)blog.Makefile

BLOG_MONTH_FILES := $(patsubst $(BLOG_IN_DIR)%.post, $(BLOG_OUT_DIR)%.pag, $(POST_FILES))
BLOG_SIX_FILES   += $(BLOG_MONTH_FILES)
#BLOG_SIX_FILES   += archive_page, years pages…
BLOG_PHP_FILES   := $(patsubst $(BLOG_BUILD_DIR)%.six, $(BLOG_OUT_DIR)%.php, $(BLOG_SIX_FILES))

ifeq ($(filter clean, $(MAKECMDGOALS)),)
-include $(POST_MAP)
endif

$(BLOG_MONTH_FILES): $(BLOG_OUT_DIR)%.pag: $(BLOG_IN_DIR)%.post
	$(SCRIPT_DIR)post-to-pag $< $@ $(*D) $(*F)

sixtus-blog: $(BLOG_PHP_FILES)
	@echo Blog is ready
	@echo $(POST_FILES)
	@echo $(POST_YEARS)
	@echo $(BLOG_SIX_FILES)
	@echo $(BLOG_PHP_FILES)

$(POST_MAP): $(POST_FILES)
	@#echo "$(POST_YEARS)\n$(POST_MONTHS)" | $(SCRIPT_DIR)make-post-map $(BLOG_IN_DIR) $(POST_MAP) $(BUILD_DIR)
	@#echo Map generated
