
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

MONTH_REL_FILE := $(BUILD_DIR)blog-month-rel.py
YEAR_REL_FILE  := $(BUILD_DIR)blog-year-rel.py
BLOG_NAME_FILE := $(BUILD_DIR)blog-names.py
BLOG_MAKE_FILE := $(BUILD_DIR)blog.Makefile

BLOG_MONTH_PAGES  += $(patsubst $(BLOG_IN_DIR)%.post, $(BLOG_OUT_DIR)%.pag, $(POST_FILES))
BLOG_YEAR_PAGES   += $(patsubst %, $(BLOG_OUT_DIR)%.pag, $(POST_YEARS))
BLOG_ARCHIVE_PAGE += $(BLOG_OUT_DIR)archive.pag
BLOG_INDEX_PAGE   += $(abspath $(BLOG_OUT_DIR)../Blog.pag)

BLOG_PAG_FILES  += $(BLOG_MONTH_PAGES)
BLOG_PAG_FILES  += $(BLOG_YEAR_FILES)
BLOG_PAG_FILES  += $(BLOG_ARCHIVE_PAGE)
BLOG_PAG_FILES  += $(BLOG_INDEX_PAGE)
PAG_FILES       += $(BLOG_PAG_FILES)

ifeq ($(filter sixtus-blog-clean clean, $(MAKECMDGOALS)),)
-include $(BLOG_MAKE_FILE)
endif

$(BLOG_MONTH_PAGES:.pag=.list): %.list: %.pag
$(BLOG_YEAR_PAGES:.pag=.list): %.list: %.pag

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
	$(SCRIPT_DIR)blog-make-archive-page $@ $(BLOG_NAME_FILE) $^
	@echo Done

$(BLOG_INDEX_PAGE):
	@echo -n "Generating blog index page $@… "
	echo $^
	exit 1
	@echo Done

$(BLOG_YEAR_FILES): $(BLOG_OUT_DIR)%.pag:
	@echo -n "Generating year page $@… "
	@echo Done

sixtus-blog: $(BLOG_PAG_FILES)
$(BLOG_OUT_DIR)%.list: $(BLOG_OUT_DIR)%.pag

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
	echo $(POST_MONTHS) |\
		$(SCRIPT_DIR)blog-make-dep-file $@ \
		$(BLOG_IN_DIR) $(BLOG_OUT_DIR) \
		$(BLOG_ARCHIVE_PAGE) $(BLOG_INDEX_PAGE)
	@echo Done

.PHONY: sixtus-blog-clean
sixtus-blog-clean:
	@echo -n "Cleaning blog files… "
	@rm -rf $(BLOG_OUT_DIR)
	@rm -f $(MONTH_REL_FILE)
	@rm -f $(YEAR_REL_FILE)
	@rm -f $(BLOG_NAME_FILE)
	@rm -f $(BLOG_MAKE_FILE)
	@echo Done

include $(MAKE_DIR)sixtus-runtime.Makefile
include $(MAKE_DIR)sixtus-pages.Makefile

clean: sixtus-runtime-clean sixtus-pages-clean sixtus-blog-clean
	@rm -f $(BLOG_PAG_FILES)
	@rm -rf $(BUILD_DIR)
	@rm -f $(PHP_FILES)
