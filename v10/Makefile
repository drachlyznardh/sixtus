
SIXTUS_DIR := /opt/devel/web/sixtus/v10/
DEPLOY_DIR := /opt/web/mobile

SIXTUS_IN_DIR := $(SIXTUS_DIR)runtime/
SIXTUS_OUT_DIR := $(DEPLOY_DIR)sixtus/

SIXTUS_RUNTIME_IN_FILES := $(shell find $(SIXTUS_IN_DIR) -name '*.css')
SIXTUS_RUNTIME_IN_FILES += $(shell find $(SIXTUS_IN_DIR) -name '*.ico')
SIXTUS_RUNTIME_IN_FILES += $(shell find $(SIXTUS_IN_DIR) -name '*.php')

sixtus_runtime: $(SIXTUS_RUNTIME_IN_FILES)
	@echo $(SIXTUS_RUNTIME_IN_FILES)
