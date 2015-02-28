
SIXTUS_DIR := /opt/devel/web/sixtus/v10/
SCRIPT_DIR := $(SIXTUS_DIR)script/
MAKE_DIR   := $(SIXTUS_DIR)make/

MAP_FILE := $(SOURCE_DIR)map.txt
PAG_DIR  := $(SOURCE_DIR)src/

BLOG_IN_DIR    := $(SOURCE_DIR)blog/
BLOG_OUT_DIR   := $(PAG_DIR)Blog/

.PHONY: sixtus-runtime sixtus-pages
.PHONY: clean
sixtus-deploy: sixtus-pages sixtus-runtime

POST_FILES  += $(sort $(shell find $(BLOG_IN_DIR) -name '*.post'))
POST_MONTHS += $(sort $(patsubst $(BLOG_IN_DIR)%.post, %, $(POST_FILES)))
POST_YEARS  += $(sort $(patsubst $(BLOG_IN_DIR)%/, %, $(dir $(POST_FILES))))

BLOG_REL_FILE  := $(BUILD_DIR)blog-rel.py
BLOG_NAME_FILE := $(BUILD_DIR)blog-names.py

BLOG_POST_FILES += $(patsubst $(BLOG_IN_DIR)%.post, $(BLOG_OUT_DIR)%.pag, $(POST_FILES))
BLOG_PAG_FILES  += $(BLOG_POST_FILES)
#BLOG_PAG_FILES  += archive_page, years pages…
PAG_FILES       += $(BLOG_PAG_FILES)

ifeq ($(filter clean, $(MAKECMDGOALS)),)
#-include $(BLOG_REL_FILE)
endif

$(BLOG_POST_FILES): $(BLOG_OUT_DIR)%.pag: $(BLOG_IN_DIR)%.post | $(BLOG_REL_FILE) $(BLOG_NAME_FILE)
	@echo -n "Generating blog page $@… "
	@mkdir -p $(dir $@)
	@$(SCRIPT_DIR)post-to-pag $< $@ $(@:.pag=.list) $(BLOG_REL_FILE) $(BLOG_NAME_FILE) $(*D) $(*F)
	@echo Done

sixtus-blog: $(BLOG_PAG_FILES)

$(BLOG_REL_FILE): $(POST_FILES)
	@echo -n "Generating blog relations file $@… "
	@echo $(POST_MONTHS) | $(SCRIPT_DIR)blog-make-rel-file $(BLOG_REL_FILE)
	@echo Done

$(BLOG_NAME_FILE): $(SITE_CONF_FILE)
	@echo -n "Generating blog names file $@… "
	@echo $(SITE_BLOG_MONTH_NAMES) | $(SCRIPT_DIR)blog-make-name-file $(BLOG_NAME_FILE)
	@echo Done
	
include $(MAKE_DIR)sixtus-runtime.Makefile
include $(MAKE_DIR)sixtus-pages.Makefile

clean: sixtus-runtime-clean
	@rm -f $(BLOG_PAG_FILES)
	@rm -rf $(BUILD_DIR)
	@rm -f $(PHP_FILES)
