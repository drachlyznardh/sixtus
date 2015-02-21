
SIXTUS_DIR := /opt/devel/web/sixtus/v10/
CMD_DIR    := $(SIXTUS_DIR)deploy/
MAKE_DIR   := $(SIXTUS_DIR)make/

MAP_FILE := $(SOURCE_DIR)map.txt
PAG_DIR  := $(SOURCE_DIR)src/

include $(MAKE_DIR)sixtus-runtime.Makefile

PAG_FILES := $(sort $(shell find $(PAG_DIR) -name '*.pag'))
TCH_FILES := $(patsubst $(PAG_DIR)%.pag, $(BUILD_DIR)%.tch, $(PAG_FILES))
SIX_FILES := $(sort $(shell find $(BUILD_DIR) -name '*.six'))
PHP_FILES := $(patsubst $(BUILD_DIR)%.six, $(DEPLOY_DIR)%.php, $(SIX_FILES))

sixtus-pages: sixtus-runtime $(TCH_FILES) $(PHP_FILES)

$(BUILD_DIR)%.tch: $(PAG_DIR)%.pag
	@$(CMD_DIR)pag-to-six.py $< $(MAP_FILE) $(*D) $(BUILD_DIR)
	@mkdir -p $(dir $@)
	@touch $@

$(DEPLOY_DIR)%.php: $(BUILD_DIR)%.six
	@mkdir -p $(dir $@)
	@$(CMD_DIR)six-to-php.py $< $(*D) > $@
