
SIXTUS_DIR := /opt/devel/web/sixtus/v10/
SCRIPT_DIR := $(SIXTUS_DIR)script/
MAKE_DIR   := $(SIXTUS_DIR)make/

MAP_FILE := $(SOURCE_DIR)map.txt
PAG_DIR  := $(SOURCE_DIR)src/

BLOG_IN_DIR    := $(SOURCE_DIR)blog/
BLOG_OUT_DIR   := $(PAG_DIR)Blog/

.PHONY: sixtus-runtime sixtus-pages
.PHONY: clean

POST_FILES  := $(sort $(shell find $(BLOG_IN_DIR) -name '*.post'))
POST_MONTHS := $(sort $(patsubst $(BLOG_IN_DIR)%.post, %, $(POST_FILES)))
POST_YEARS  := $(sort $(patsubst $(BLOG_IN_DIR)%/, %, $(dir $(POST_FILES))))

BLOG_REL_FILE  := $(BUILD_DIR)blog-rel.py
BLOG_NAME_FILE := $(BUILD_DIR)blog-names.py

BLOG_MONTH_FILES := $(patsubst $(BLOG_IN_DIR)%.post, $(BLOG_OUT_DIR)%.pag, $(POST_FILES))
BLOG_PAG_FILES   += $(BLOG_MONTH_FILES)
#BLOG_PAG_FILES   += archive_page, years pages…
BLOG_PHP_FILES   := $(patsubst $(BLOG_BUILD_DIR)%.six, $(BLOG_OUT_DIR)%.php, $(BLOG_PAG_FILES))

ifeq ($(filter clean, $(MAKECMDGOALS)),)
#-include $(BLOG_REL_FILE)
endif

$(BLOG_MONTH_FILES): $(BLOG_OUT_DIR)%.pag: $(BLOG_IN_DIR)%.post | $(BLOG_REL_FILE) $(BLOG_NAME_FILE)
	@mkdir -p $(dir $@)
	@$(SCRIPT_DIR)post-to-pag $< $@ $(BLOG_REL_FILE) $(BLOG_NAME_FILE) $(*D) $(*F)

sixtus-blog: $(BLOG_PAG_FILES)
	@echo Blog is ready
	@echo $(POST_FILES)
	@echo $(POST_YEARS)
	@echo $(BLOG_PAG_FILES)
	@echo $(BLOG_PHP_FILES)

$(BLOG_REL_FILE): $(POST_FILES)
	@echo $(POST_MONTHS) | $(SCRIPT_DIR)make-rel-file $(BLOG_REL_FILE)
	
culo:
	@#echo "$(POST_YEARS)\n$(POST_MONTHS)" |\
		$(SCRIPT_DIR)make-post-map $(BLOG_IN_DIR) $(BLOG_REL_FILE) $(BUILD_DIR) # > $(BLOG_REL_FILE)
	@echo Map generated

include $(MAKE_DIR)sixtus-runtime.Makefile
include $(MAKE_DIR)sixtus-pages.Makefile

