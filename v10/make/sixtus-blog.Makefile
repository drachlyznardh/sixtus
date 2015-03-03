
SIXTUS_DEBUG=1

all: sixtus-blog

DEP_FILE := $(BLOG_OUT_DIR)blog.dep
MAP_FILE := $(BLOG_OUT_DIR)blog.map

POST_FILES  := $(sort $(shell find $(BLOG_IN_DIR) -name '*.post'))
POST_MONTHS := $(patsubst $(BLOG_IN_DIR)%.post,%,$(POST_FILES))

#POST_MONTHS += $(sort $(patsubst $(BLOG_IN_DIR)%.post, %, $(POST_FILES)))
#POST_YEARS  += $(sort $(patsubst $(BLOG_IN_DIR)%/, %, $(dir $(POST_FILES))))

#MONTH_REL_FILE := $(BUILD_DIR)blog-month-rel.py
#YEAR_REL_FILE  := $(BUILD_DIR)blog-year-rel.py
#STABLE_MAP     := $(BUILD_DIR)stable-map.py
#NAME_FILE := $(BUILD_DIR)blog-names.py
#FULL_DEPS := $(BUILD_DIR)blog-full.dep
#FAST_DEPS := $(BUILD_DIR)blog-fast.dep

#HELP_FILES := $(MONTH_REL_FILE ) $(YEAR_REL_FILE ) $(NAME_FILE)
#$(FULL_DEPS): | $(BUILD_DIR)
#$(HELP_FILES): | $(BUILD_DIR) $(BLOG_OUT_DIR) $(FULL_DEPS)

# Ensuring directory presence
#$(DEPLOY_DIR) $(BUILD_DIR) $(BLOG_OUT_DIR): %:
$(BLOG_OUT_DIR):
	@mkdir -p $@

MONTH_PAGES  := $(patsubst $(BLOG_IN_DIR)%.post,$(BLOG_OUT_DIR)%.pag,$(POST_FILES))
#YEAR_PAGES   := $(patsubst %, $(BLOG_OUT_DIR)%.pag, $(POST_YEARS))
YEAR_PAGES   := $(patsubst $(BLOG_IN_DIR)%/,$(BLOG_OUT_DIR)%.pag,$(sort $(dir $(POSTS))))
ARCHIVE_PAGE := $(BLOG_OUT_DIR)$(SITE_ARCHIVE_BASENAME).pag
INDEX_PAGE   := $(BLOG_OUT_DIR)index.pag

PAG_FILES += $(MONTH_PAGES)
PAG_FILES += $(YEAR_FILES)
PAG_FILES += $(ARCHIVE_PAGE)
PAG_FILES += $(INDEX_PAGE)

ifdef SIXTUS_DEBUG
$(warning $$POST_FILES = [$(POST_FILES)])
$(warning $$POST_MONTHS = [$(POST_MONTHS)])
endif

#sixtus-blog: $(PAG_FILES) | $(HELP_FILES)
sixtus-blog: $(PAG_FILES) $(MAP_FILE)
#$(BLOG_OUT_DIR)%.list: $(BLOG_OUT_DIR)%.pag

ifeq ($(filter %clean, $(MAKECMDGOALS)),)
#ifneq ($(shell $(SCRIPT_DIR)blog-check-update $(STABLE_MAP) $(POST_MONTHS)),)
#$(warning Blog structure update)
#-include $(FULL_DEPS)
#else
#$(warning Blog structure unchanged)
#-include $(FAST_DEPS)
#endif
-include $(DEP_FILE)
endif

$(DEP_FILE): $(POST_FILES) | $(BLOG_OUT_DIR)
	@echo -n "Generating dependency file $@… "
	@$(SCRIPT_DIR)blog-make-dep-file $(DEP_FILE) $(MAP_FILE) $(POST_MONTHS)
	@echo Done

$(MONTH_PAGES:.pag=.list): %.list: %.pag
	@echo -n "Generating month list file $@… "
	@touch $@
	@echo Done

$(YEAR_PAGES:.pag=.list): %.list: %.pag
	@echo -n "Generating year list file $@… "
	@touch $@
	@echo Done

$(MONTH_PAGES): $(BLOG_OUT_DIR)%.pag: $(BLOG_IN_DIR)%.post
	@echo -n "Generating month page $@… "
	@touch $@
	@echo Done

$(YEAR_PAGES): %.pag
	@echo -n "Generating year page $@… "
	@touch $@
	@echo Done

$(INDEX_PAGE):
	@echo -n "Generating index page $@… "
	@touch $@
	@echo Done

$(ARCHIVE_PAGE):
	@echo -n "Generating archive page $@… "
	@touch $@
	@echo Done

$(MAP_FILE): $(ARCHIVE_PAGE)
	@echo -n "Updating blog map $@… "
	@$(SCRIPT)blog-update-map $@ $(POST_MONHTS)
	@echo Done

########

#%.list: %.pag | $(HELP_FILES)
#	@echo Hello! $< $@
#	@touch $@

#$(YEAR_PAGES:.pag=.list): %.list: %.post | $(HELP_FILES)
#	@echo Hello! $< $@
#	@touch $@

#$(PAG_FILES): | $(HELP_FILES)

#$(MONTH_PAGES): $(BLOG_OUT_DIR)%.pag: $(BLOG_IN_DIR)%.post | $(MONTH_REL_FILE) $(NAME_FILE)
#	@echo -n "Generating blog month page $@… "
#	@mkdir -p $(dir $@)
#	@$(SCRIPT_DIR)post-to-pag $< $@ $(@:.pag=.list) $(MONTH_REL_FILE) $(NAME_FILE) $(*D) $(*F)
#	@echo Done

#$(YEAR_PAGES): $(BLOG_OUT_DIR)%.pag: | $(YEAR_REL_FILE)
#	@echo -n "Generating blog year page $@… "
#	@$(SCRIPT_DIR)blog-make-year-page $@ $(@:.pag=.list) $(*F) $(YEAR_REL_FILE) $(NAME_FILE) $^
#	@echo Done

#$(ARCHIVE_PAGE):
#	@echo -n "Generating blog archive page $@… "
#	@$(SCRIPT_DIR)blog-make-archive-page $@ $(NAME_FILE) $^
#	@$(SCRIPT_DIR)blog-update $(STABLE_MAP) $(POST_MONTHS)
#	@echo Done

#$(INDEX_PAGE):
#	@echo -n "Generating blog index page $@… "
#	@$(SCRIPT_DIR)blog-make-index-page $@ $(patsubst $(BLOG_IN_DIR)%.post, %, $^)
#	@echo Done

#$(MONTH_REL_FILE): $(POST_FILES)
#	@echo -n "Generating month relations file $@… "
#	@echo $(POST_MONTHS) |\
#		$(SCRIPT_DIR)blog-make-month-rel-file $(MONTH_REL_FILE)
#	@echo Done

#$(YEAR_REL_FILE): $(POST_FILES)
#	@echo -n "Generating year relations file $@… "
#	@$(SCRIPT_DIR)blog-make-year-rel-file $(YEAR_REL_FILE) $(POST_YEARS)
#	@echo Done

#$(NAME_FILE): $(SITE_CONF_FILE)
#	@echo -n "Generating blog names file $@… "
#	@$(SCRIPT_DIR)blog-make-name-file $(NAME_FILE) $(SITE_MONTH_NAMES)
#	@echo Done
	
#$(FULL_DEPS):
#	@echo -n "Generating blog full dependencies… "
#	@echo $(POST_MONTHS) |\
#		$(SCRIPT_DIR)blog-make-dep-full $@ \
#		$(BLOG_IN_DIR) $(BLOG_OUT_DIR) \
#		$(ARCHIVE_PAGE) $(INDEX_PAGE)
#	@echo Done

#$(FAST_DEPS):
#	@echo -n "Generating blog fast dependencies… "
#	@echo $(POST_MONTHS) |\
#		$(SCRIPT_DIR)blog-make-dep-fast $@ \
#		$(BLOG_IN_DIR) $(BLOG_OUT_DIR) \
#		$(ARCHIVE_PAGE) $(INDEX_PAGE)
#	@echo Done

.PHONY: clean sixtus-blog-clean
clean: sixtus-blog-clean
sixtus-blog-clean:
	@echo -n "Cleaning blog files… "
	@rm -rf $(BLOG_OUT_DIR) $(INDEX_PAGE)
	@rm -f $(MONTH_REL_FILE) $(YEAR_REL_FILE)
	@rm -f $(NAME_FILE) $(FAST_DEPS) $(FULL_DEPS)
	@echo Done
