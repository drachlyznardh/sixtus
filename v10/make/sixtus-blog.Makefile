
POST_FILES  += $(sort $(shell find $(BLOG_IN_DIR) -name '*.post'))
POST_MONTHS += $(sort $(patsubst $(BLOG_IN_DIR)%.post, %, $(POST_FILES)))
POST_YEARS  += $(sort $(patsubst $(BLOG_IN_DIR)%/, %, $(dir $(POST_FILES))))

MONTH_REL_FILE := $(BUILD_DIR)blog-month-rel.py
YEAR_REL_FILE  := $(BUILD_DIR)blog-year-rel.py
STABLE_MAP     := $(BUILD_DIR)stable-map.py
BLOG_NAME_FILE := $(BUILD_DIR)blog-names.py
BLOG_MAKE_FILE := $(BUILD_DIR)blog.Makefile

BLOG_HELP_FILES := $(MONTH_REL_FILE ) $(YEAR_REL_FILE ) $(BLOG_NAME_FILE)
$(BLOG_MAKE_FILE): | $(BUILD_DIR)
$(BLOG_HELP_FILES): | $(BUILD_DIR) $(BLOG_OUT_DIR) $(BLOG_MAKE_FILE)

# Ensuring directory presence
$(DEPLOY_DIR) $(BUILD_DIR) $(BLOG_OUT_DIR): %:
	@mkdir -p $@

BLOG_MONTH_PAGES  := $(patsubst $(BLOG_IN_DIR)%.post, $(BLOG_OUT_DIR)%.pag, $(POST_FILES))
BLOG_YEAR_PAGES   := $(patsubst %, $(BLOG_OUT_DIR)%.pag, $(POST_YEARS))
BLOG_ARCHIVE_PAGE := $(BLOG_OUT_DIR)$(SITE_BLOG_ARCHIVE_BASENAME).pag
BLOG_INDEX_PAGE   := $(abspath $(BLOG_OUT_DIR)../Blog.pag)

BLOG_PAG_FILES += $(BLOG_MONTH_PAGES)
BLOG_PAG_FILES += $(BLOG_YEAR_FILES)
BLOG_PAG_FILES += $(BLOG_ARCHIVE_PAGE)
BLOG_PAG_FILES += $(BLOG_INDEX_PAGE)

all: sixtus-blog
sixtus-blog: $(BLOG_PAG_FILES) | $(BLOG_HELP_FILES)
$(BLOG_OUT_DIR)%.list: $(BLOG_OUT_DIR)%.pag

ifeq ($(filter %clean, $(MAKECMDGOALS)),)
$(warning Filter clean triggered)
ifneq ($(shell $(SCRIPT_DIR)blog-check-update $(STABLE_MAP) $(POST_MONTHS)),)
$(warning Blog Updates triggered)
-include $(BLOG_MAKE_FILE)
endif
endif

$(BLOG_MONTH_PAGES:.pag=.list): %.list: %.pag | $(BLOG_HELP_FILES)
$(BLOG_YEAR_PAGES:.pag=.list): %.list: %.pag | $(BLOG_HELP_FILES)
$(BLOG_PAG_FILES): | $(BLOG_HELP_FILES)

$(BLOG_MONTH_PAGES): $(BLOG_OUT_DIR)%.pag: $(BLOG_IN_DIR)%.post | $(MONTH_REL_FILE) $(BLOG_NAME_FILE)
	@echo -n "Generating blog month page $@… "
	@mkdir -p $(dir $@)
	@$(SCRIPT_DIR)post-to-pag $< $@ $(@:.pag=.list) $(MONTH_REL_FILE) $(BLOG_NAME_FILE) $(*D) $(*F)
	@echo Done

$(BLOG_YEAR_PAGES): $(BLOG_OUT_DIR)%.pag: | $(YEAR_REL_FILE)
	@echo -n "Generating blog year page $@… "
	@$(SCRIPT_DIR)blog-make-year-page $@ $(@:.pag=.list) $(*F) $(YEAR_REL_FILE) $(BLOG_NAME_FILE) $^
	@echo Done

$(BLOG_ARCHIVE_PAGE):
	@echo -n "Generating blog archive page $@… "
	@$(SCRIPT_DIR)blog-make-archive-page $@ $(BLOG_NAME_FILE) $^
	@$(SCRIPT_DIR)blog-update $(STABLE_MAP) $(POST_MONTHS)
	@echo Done

$(BLOG_INDEX_PAGE):
	@echo -n "Generating blog index page $@… "
	@$(SCRIPT_DIR)blog-make-index-page $@ $(patsubst $(BLOG_IN_DIR)%.post, %, $^)
	@echo Done

$(MONTH_REL_FILE): $(POST_FILES)
	@echo -n "Generating month relations file $@… "
	@echo $(POST_MONTHS) |\
		$(SCRIPT_DIR)blog-make-month-rel-file $(MONTH_REL_FILE)
	@echo Done

$(YEAR_REL_FILE): $(POST_FILES)
	@echo -n "Generating year relations file $@… "
	@$(SCRIPT_DIR)blog-make-year-rel-file $(YEAR_REL_FILE) $(POST_YEARS)
	@echo Done

$(BLOG_NAME_FILE): $(SITE_CONF_FILE)
	@echo -n "Generating blog names file $@… "
	@$(SCRIPT_DIR)blog-make-name-file $(BLOG_NAME_FILE) $(SITE_BLOG_MONTH_NAMES)
	@echo Done
	
$(BLOG_MAKE_FILE):
	@echo -n "Generating blog dependencies… "
	@echo $(POST_MONTHS) |\
		$(SCRIPT_DIR)blog-make-dep-file $@ \
		$(BLOG_IN_DIR) $(BLOG_OUT_DIR) \
		$(BLOG_ARCHIVE_PAGE) $(BLOG_INDEX_PAGE)
	@echo Done

.PHONY: clean sixtus-blog-clean
clean: sixtus-blog-clean
sixtus-blog-clean:
	@echo -n "Cleaning blog files… "
	@rm -rf $(BLOG_OUT_DIR) $(BLOG_INDEX_PAGE)
	@rm -f $(MONTH_REL_FILE) $(YEAR_REL_FILE)
	@rm -f $(BLOG_NAME_FILE) $(BLOG_MAKE_FILE)
	@echo Done
