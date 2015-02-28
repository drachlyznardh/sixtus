
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

$(BLOG_MONTH_PAGES): $(BLOG_OUT_DIR)%.pag: $(BLOG_IN_DIR)%.post | $(BLOG_REL_FILE) $(BLOG_NAME_FILE)
	@echo -n "Generating blog month page $@… "
	@mkdir -p $(dir $@)
	@$(SCRIPT_DIR)post-to-pag $< $@ $(@:.pag=.list) $(BLOG_REL_FILE) $(BLOG_NAME_FILE) $(*D) $(*F)
	@echo Done

$(BLOG_YEAR_FILES): $(BLOG_OUT_DIR)%.pag:
	@echo -n "Generating blog year page $@… "
	@echo Done

$(BLOG_ARCHIVE_PAGE):
	@echo -n "Generating blog archive page $@… "
	@echo Done

$(BLOG_INDEX_PAGE):
	@echo -n "Generating blog index page $@… "
	@echo Done

$(BLOG_YEAR_FILES): $(BLOG_OUT_DIR)%.pag:
	@echo -n "Generating year page $@… "
	@echo Done

sixtus-blog: $(BLOG_PAG_FILES)
$(BLOG_OUT_DIR)%.list: $(BLOG_OUT_DIR)%.pag

$(BLOG_REL_FILE): $(POST_FILES)
	@echo -n "Generating blog relations file $@… "
	@echo $(POST_MONTHS) |\
		$(SCRIPT_DIR)blog-make-rel-file $(BLOG_REL_FILE) $(BLOG_IN_DIR)
	@echo Done

$(BLOG_NAME_FILE): $(SITE_CONF_FILE)
	@echo -n "Generating blog names file $@… "
	@echo $(SITE_BLOG_MONTH_NAMES) | $(SCRIPT_DIR)blog-make-name-file $(BLOG_NAME_FILE)
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
	@echo Done

include $(MAKE_DIR)sixtus-runtime.Makefile
include $(MAKE_DIR)sixtus-pages.Makefile

clean: sixtus-runtime-clean sixtus-pages-clean sixtus-blog-clean
	@rm -f $(BLOG_PAG_FILES)
	@rm -rf $(BUILD_DIR)
	@rm -f $(PHP_FILES)
