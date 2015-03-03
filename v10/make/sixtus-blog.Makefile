
SIXTUS_DEBUG=1

all: sixtus-blog

DEP_FILE  := $(BLOG_OUT_DIR)blog.dep
MAP_FILE  := $(BLOG_OUT_DIR)blog.map
NAME_FILE := $(BLOG_OUT_DIR)blog.names

POST_FILES  := $(sort $(shell find $(BLOG_IN_DIR) -name '*.post'))
POST_MONTHS := $(patsubst $(BLOG_IN_DIR)%.post,%,$(POST_FILES))

$(BLOG_OUT_DIR):
	@mkdir -p $@

MONTH_PAGES  := $(patsubst $(BLOG_IN_DIR)%.post,$(BLOG_OUT_DIR)%.pag,$(POST_FILES))
YEAR_PAGES   := $(patsubst $(BLOG_IN_DIR)%/,$(BLOG_OUT_DIR)%.pag,$(sort $(dir $(POST_FILES))))
ARCHIVE_PAGE := $(BLOG_OUT_DIR)$(SITE_BLOG_ARCHIVE_BASENAME).pag
INDEX_PAGE   := $(BLOG_OUT_DIR)index.pag

PAG_FILES += $(MONTH_PAGES)
PAG_FILES += $(YEAR_PAGES)
PAG_FILES += $(ARCHIVE_PAGE)
PAG_FILES += $(INDEX_PAGE)

ifdef SIXTUS_DEBUG
$(warning $$POST_FILES   = [$(POST_FILES)])
$(warning $$POST_MONTHS  = [$(POST_MONTHS)])
$(warning )
$(warning $$MONTH_PAGES  = [$(MONTH_PAGES)])
$(warning $$YEAR_PAGES   = [$(YEAR_PAGES)])
$(warning $$ARCHIVE_PAGE = [$(ARCHIVE_PAGE)])
$(warning $$INDEX_PAGE   = [$(INDEX_PAGE)])
endif

sixtus-blog: $(PAG_FILES) $(MAP_FILE)

ifeq ($(filter %clean, $(MAKECMDGOALS)),)
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
	@mkdir -p $(dir $@)
	@touch $@
	@echo Done

$(YEAR_PAGES): %.pag:
	@echo -n "Generating year page $@… "
	@touch $@
	@echo Done

$(INDEX_PAGE):
	@echo -n "Generating index page $@… "
	@$(SCRIPT_DIR)blog-make-index-page $@ $(patsubst $(BLOG_IN_DIR)%.post, %, $^)
	@echo Done

$(ARCHIVE_PAGE): $(NAME_FILE)
	@echo -n "Generating archive page $@… "
	@$(SCRIPT_DIR)blog-make-archive-page $@ $(NAME_FILE) $(filter %.list, $^)
	@echo Done

$(MAP_FILE): $(ARCHIVE_PAGE)
	@echo -n "Updating blog map $@… "
	@$(SCRIPT_DIR)blog-update-map $@ $(POST_MONHTS)
	@echo Done

########

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

$(NAME_FILE): $(SITE_CONF_FILE)
	@echo -n "Generating blog names file $@… "
	@$(SCRIPT_DIR)blog-make-name-file $(NAME_FILE) $(SITE_BLOG_MONTH_NAMES)
	@echo Done
	
.PHONY: clean sixtus-blog-clean
clean: sixtus-blog-clean
sixtus-blog-clean:
	@echo -n "Cleaning blog files… "
	@rm -rf $(BLOG_OUT_DIR)
	@echo Done
