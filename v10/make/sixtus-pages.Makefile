
PAG_FILES += $(sort $(shell find $(PAG_DIR) -name '*.pag'))
DEP_FILES += $(patsubst $(PAG_DIR)%.pag, $(BUILD_DIR)%.dep, $(PAG_FILES))

.PRECIOUS: $(patsubst $(PAG_DIR)%.pag, $(BUILD_DIR)%.Six, $(PAG_FILES))
.PRECIOUS: $(patsubst $(PAG_DIR)%.pag, $(BUILD_DIR)%.tab, $(PAG_FILES))

all: sixtus-pages

ifeq ($(filter %clean,$(MAKECMDGOALS)),)
-include $(DEP_FILES)
endif

SIX_PAGE_FILES := $(filter %page.six, $(SIX_FILES))
SIX_SIDE_FILES := $(filter %side.six, $(SIX_FILES))
SIX_JUMP_FILES := $(filter %jump.six, $(SIX_FILES))

DONE_FILES := $(addsuffix .done, $(SIX_DIRS))

PHP_PAGE_FILES := $(patsubst $(BUILD_DIR)%page.six, $(DEPLOY_DIR)%index.php, $(SIX_PAGE_FILES))
PHP_SIDE_FILES := $(patsubst $(BUILD_DIR)%side.six, $(DEPLOY_DIR)%side.php, $(SIX_SIDE_FILES))
PHP_JUMP_FILES := $(patsubst $(BUILD_DIR)%jump.six, $(DEPLOY_DIR)%index.php, $(SIX_JUMP_FILES))

sixtus-pages: $(DEP_FILES) $(PHP_PAGE_FILES) $(PHP_SIDE_FILES) $(PHP_JUMP_FILES)

$(BUILD_DIR)%.Six: $(PAG_DIR)%.pag
	@echo -n "Expanding source file $<… "
	@mkdir -p $(dir $@)
	@$(SCRIPT_DIR)pag-to-Six $< $(dir $<) $@
	@echo Done

$(BUILD_DIR)%.tab: $(BUILD_DIR)%.Six
	@echo -n "Extracting components from file $<… "
	@mkdir -p $(dir $@)
	@$(SCRIPT_DIR)Six-to-tab $< $@
	@echo Done

$(BUILD_DIR)%.dep: $(BUILD_DIR)%.tab $(SITE_MAP_FILE)
	@echo -n "Extracting dependencies for file $<… "
	@mkdir -p $(dir $@)
	@$(SCRIPT_DIR)tab-to-dep $< $(SITE_MAP_FILE) $(BUILD_DIR) $(*D) $(*F) $@
	@echo Done

$(DONE_FILES): %:
	@echo -n "Splipping source file $<… "
	@$(SCRIPT_DIR)Six-to-done $(patsubst $(PAG_DIR)%.pag,$(BUILD_DIR)%.Six,$<) $(*D) $@
	@echo Done

$(PHP_PAGE_FILES): $(DEPLOY_DIR)%index.php: $(BUILD_DIR)%page.six
	@echo -n "Generating page file $@… "
	@mkdir -p $(dir $@)
	@$(SCRIPT_DIR)six-page-to-php $< $(*D) $@
	@echo Done

$(PHP_SIDE_FILES): $(DEPLOY_DIR)%side.php: $(BUILD_DIR)%side.six
	@echo -n "Generating side file $@… "
	@mkdir -p $(dir $@)
	@$(SCRIPT_DIR)six-side-to-php $< $(*D) $@
	@echo Done

$(PHP_JUMP_FILES): $(DEPLOY_DIR)%index.php: $(BUILD_DIR)%jump.six
	@echo -n "Generating jump file $@… "
	@mkdir -p $(dir $@)
	@$(SCRIPT_DIR)six-jump-to-php $< $@
	@echo Done

.PHONY: clean sixtus-pages-clean
clean: sixtus-pages-clean
sixtus-pages-clean:
	@echo -n "Cleaning pages files… "
	@rm -rf $(BUILD_DIR)
	@echo Done
