
PREFIX := /opt/devel/web/sixtus/
LYZ_TO_PHP := $(PREFIX)transform/lyz-to-php.php
LYZ_TO_DEP := $(PREFIX)transform/lyz-to-dep.php
PAG_TO_TAG := $(PREFIX)transform/pag-to-tag.php

SRC_DIR := $(IN_DIR)src/
RES_DIR := $(IN_DIR)res/
SYS_DIR := $(IN_DIR)sys/
DEP_DIR := $(IN_DIR).dep/
TAG_DIR := $(IN_DIR).tag/
DEST_DIR := $(OUT_DIR)

LYZS := $(sort $(shell find $(SRC_DIR) -name '*.lyz'))
PAGS := $(sort $(shell find $(SRC_DIR) -name '*.pag'))
SYSS := $(sort $(shell find $(SYS_DIR) -type f))
RESS := $(sort $(shell find $(RES_DIR) -type f))

PHPS := $(patsubst $(SRC_DIR)%.lyz, $(DEST_DIR)%.php, $(LYZS))
DEPS := $(patsubst $(SRC_DIR)%.lyz, $(DEP_DIR)%.dep, $(LYZS))
TAGS := $(patsubst $(SRC_DIR)%.pag, $(TAG_DIR)%.php, $(PAGS))
O_RESS := $(patsubst $(RES_DIR)%, $(DEST_DIR)%, $(RESS))
O_SYSS := $(patsubst $(SYS_DIR)%, $(DEST_DIR)%, $(SYSS))

all: $(DEPS) pages resources system tags
#	@printf "in = %s, out = %s\n" $(IN_DIR) $(OUT_DIR)
#	@printf "src = %s, res = %s, sys = %s, out = %s\n" $(SRC_DIR) $(RES_DIR) $(SYS_DIR) $(DEST_DIR)
#	@echo System: $(SYSS)

pages: $(PHPS)
resources: $(O_RESS)
system: $(O_SYSS)
tags: $(TAGS)

#Dependency generation
$(DEP_DIR)%.dep: $(SRC_DIR)%.lyz
	@echo Generating dependencies for page $@
	@mkdir -p $(dir $@)
	@php5 -f $(LYZ_TO_DEP) $< $(patsubst $(SRC_DIR)%.lyz, $(DEST_DIR)%.php, $<) > $@

#Tag generation
$(TAG_DIR)%.php: $(SRC_DIR)%.pag
	@echo Generating tags for page $@
	@mkdir -p $(dir $@)
	@php5 -f $(PAG_TO_TAG) $< $(patsubst $(SRC_DIR)%.pag, $(TAG_DIR)%.php, $<)

#File generation
$(DEST_DIR)%.php: $(SRC_DIR)%.lyz
	@echo Generating page $@
	@mkdir -p $(dir $@)
	@php5 -f $(LYZ_TO_PHP) $(SRC_DIR) $< > $@ || (more $@ && $(RM) $@ && return 1)

#File linking
$(DEST_DIR)%: $(RES_DIR)%
	@echo Linking resource file $@
	@mkdir -p $(dir $@)
	@$(LN_CMD) $< $@

$(DEST_DIR)%: $(SYS_DIR)%
	@echo Linking system file $@
	@mkdir -p $(dir $@)
	@$(LN_CMD) $< $@

#Cleaning
.PHONY: clean
clean:
	@$(RM) $(DEPS)
	@$(RM) $(PHPS)
	@$(RM) $(O_RESS)
	@$(RM) $(O_SYSS)

-include $(DEPS)
