
SIXTUS_DIR := /opt/devel/web/sixtus/v10/
CMD_DIR    := $(SIXTUS_DIR)deploy/
MAKE_DIR   := $(SIXTUS_DIR)make/

include $(MAKE_DIR)sixtus-runtime.Makefile

SIX_FILES := $(shell find $(BUILD_DIR) -name '*.six')
PHP_FILES := $(patsubst $(BUILD_DIR)%.six, $(DEPLOY_DIR)%.php, $(SIX_FILES))

sixtus-pages: $(PHP_FILES)
	@echo $(SIX_FILES)
	@echo $(PHP_FILES)

$(DEPLOY_DIR)%.php: $(BUILD_DIR)%.six
	@echo $< $@
