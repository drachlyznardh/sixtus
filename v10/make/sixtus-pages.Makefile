PAG_FILES := $(sort $(shell find $(PAG_DIR) -name '*.pag'))
TCH_FILES := $(patsubst $(PAG_DIR)%.pag, $(BUILD_DIR)%.tch, $(PAG_FILES))

ifeq ($(filter clean,$(MAKECMDGOALS)),)
-include $(TCH_FILES)
endif

PHP_FILES := $(patsubst $(BUILD_DIR)%.six, $(DEPLOY_DIR)%.php, $(SIX_FILES))

sixtus-deploy: sixtus-pages sixtus-runtime
sixtus-pages: sixtus-runtime $(TCH_FILES) $(PHP_FILES)

$(BUILD_DIR)%.tch: $(PAG_DIR)%.pag
	@echo Splitting source file $<
	@mkdir -p $(dir $@)
	@$(SCRIPT_DIR)pag-to-six.py $< $(MAP_FILE) $(*D) $(*F) $(BUILD_DIR) $@

%.six:
	@echo Splitting source file [$<] [$@]
	@mkdir -p $(patsubst $(PAG_DIR)%, $(BUILD_DIR)%, $(dir $<))
	@$(SCRIPT_DIR)pag-to-six.py\
		$(filter %.pag, $^)\
		$(MAP_FILE)\
		$(patsubst $(PAG_DIR)%/, %, $(dir $<))\
		$(basename $(notdir $<))\
		$(BUILD_DIR)\
		$(patsubst %.pag, %.tch, $(filter %.pag, $^))

$(DEPLOY_DIR)%.php: $(BUILD_DIR)%.six
	@echo Generating page file $@
	@mkdir -p $(dir $@)
	@$(SCRIPT_DIR)six-to-php.py $< $(*D) $@

clean:
	@rm -rf $(BUILD_DIR)
	@rm -rf $(PHP_FILES)
