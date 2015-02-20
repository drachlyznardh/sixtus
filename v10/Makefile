
SIXTUS_DIR := /opt/devel/web/sixtus/v10/
DEPLOY_DIR := /opt/web/mobile/

SIXTUS_IN_DIR := $(SIXTUS_DIR)runtime/
SIXTUS_OUT_DIR := $(DEPLOY_DIR)sixtus/

SIXTUS_RUNTIME_IN_FILES := $(shell find $(SIXTUS_IN_DIR) -name '*.css')
SIXTUS_RUNTIME_IN_FILES += $(shell find $(SIXTUS_IN_DIR) -name '*.ico')
SIXTUS_RUNTIME_IN_FILES += $(shell find $(SIXTUS_IN_DIR) -name '*.php')

SIXTUS_RUNTIME_FILES += style.css icon.ico
SIXTUS_RUNTIME_FILES += page-top.php page-middle.php page-bottom.php

SIXTUS_RUNTIME_OUT_FILES += $(addprefix $(SIXTUS_OUT_DIR), $(SIXTUS_RUNTIME_FILES))

sixtus_runtime:
	@echo $(SIXTUS_RUNTIME_IN_FILES)
	@echo $(SIXTUS_RUNTIME_FILES)
	@echo $(SIXTUS_RUNTIME_OUT_FILES)
