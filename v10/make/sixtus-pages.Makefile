PAG_FILES += $(sort $(shell find $(PAG_DIR) -name '*.pag'))
TCH_FILES += $(patsubst $(PAG_DIR)%.pag, $(BUILD_DIR)%.tch, $(PAG_FILES))

ifeq ($(filter clean,$(MAKECMDGOALS)),)
-include $(TCH_FILES)
endif

PHP_FILES += $(patsubst $(BUILD_DIR)%.page.six, $(DEPLOY_DIR)%.php, $(filter %.page.six, $(SIX_FILES)))
PHP_FILES += $(patsubst $(BUILD_DIR)%.side.six, $(DEPLOY_DIR)%.side.php, $(filter %.side.six, $(SIX_FILES)))
PHP_FILES += $(patsubst $(BUILD_DIR)%.jump.six, $(DEPLOY_DIR)%.php, $(filter %.jump.six, $(SIX_FILES)))

sixtus-pages: $(TCH_FILES) $(PHP_FILES)

$(BUILD_DIR)%.tch: $(PAG_DIR)%.pag
	@echo Splitting source file $<
	@mkdir -p $(dir $@)
	@$(SCRIPT_DIR)pag-to-six $< $(MAP_FILE) $(*D) $(*F) $(BUILD_DIR) $@

$(BUILD_DIR)%.six:
	@echo Splitting source file $<
	@mkdir -p $(patsubst $(PAG_DIR)%, $(BUILD_DIR)%, $(dir $<))
	@$(SCRIPT_DIR)pag-to-six\
		$(filter %.pag, $^)\
		$(MAP_FILE)\
		$(patsubst $(PAG_DIR)%/, %, $(dir $<))\
		$(basename $(notdir $<))\
		$(BUILD_DIR)\
		$(patsubst $(PAG_DIR)%.pag, $(BUILD_DIR)%.tch, $(filter %.pag, $^))

$(DEPLOY_DIR)%.php: $(BUILD_DIR)%.page.six
	@echo -n "Generating page file $@… "
	@$(SCRIPT_DIR)six-page-to-php $< $(*D) $@
	@echo Done

$(DEPLOY_DIR)%.side.php: $(BUILD_DIR)%.side.six
	@echo -n "Generating side file $@… "
	@$(SCRIPT_DIR)six-side-to-php $< $(*D) $@
	@echo Done

$(DEPLOY_DIR)%.php: $(BUILD_DIR)%.jump.six
	@echo -n "Generating jump file $@… "
	@$(SCRIPT_DIR)six-jump-to-php $< $@
	@echo Done

$(DEPLOY_DIR)%.php: $(BUILD_DIR)%.six
	@echo Generating page file $@
	@mkdir -p $(dir $@)
	@$(SCRIPT_DIR)six-to-php $< $(*D) $@
