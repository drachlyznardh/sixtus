
PREFIX := /opt/devel/web/sixtus/
LYZ_TO_PHP := $(PREFIX)transform/lyz-to-php.php
LYZ_TO_DEP := $(PREFIX)transform/lyz-to-dep.php
PAG_TO_TAG := $(PREFIX)transform/pag-to-tag.php
DBS_TO_TOT := $(PREFIX)transform/dbs-to-tot.php

SRC_DIR  := $(IN_DIR)src/
RES_DIR  := $(IN_DIR)res/
SYS_DIR  := $(IN_DIR)sys/
DEP_DIR  := $(IN_DIR).dep/
TAG_DIR  := $(IN_DIR).tag/
DB_DIR   := $(IN_DIR).db/
DEST_DIR := $(OUT_DIR)

CLOUD_FILE := $(IN_DIR).cloud.php
MAP_FILE   := $(IN_DIR)sys/sys/runtime.php

LYZS := $(sort $(shell find $(SRC_DIR) -name '*.lyz'))
PAGS := $(sort $(shell find $(SRC_DIR) -name '*.pag'))
SYSS := $(sort $(shell find $(SYS_DIR) -type f))
RESS := $(sort $(shell find $(RES_DIR) -type f))
#DBS  := $(sort $(shell find $(DB_DIR) -type f))

PHPS   := $(patsubst $(SRC_DIR)%.lyz, $(DEST_DIR)%.php, $(LYZS))
PHPS   += $(patsubst $(SRC_DIR)%.pag, $(DEST_DIR)%.php, $(PAGS))
DEPS   := $(patsubst $(SRC_DIR)%.lyz, $(DEP_DIR)%.dep, $(LYZS))
DEPS   += $(patsubst $(SRC_DIR)%.pag, $(DEP_DIR)%.dep, $(PAGS))
TAGS   := $(patsubst $(SRC_DIR)%.pag, $(TAG_DIR)%.php, $(PAGS))
O_RESS := $(patsubst $(RES_DIR)%, $(DEST_DIR)%, $(RESS))
O_SYSS := $(patsubst $(SYS_DIR)%, $(DEST_DIR)%, $(SYSS))
O_DBS  := $(patsubst $(IN_DIR)%, $(DEST_DIR)%, $(DBS))

all: $(DEPS) pages resources system tags dbs
#	@printf "in = %s, out = %s\n" $(IN_DIR) $(OUT_DIR)
#	@printf "src = %s, res = %s, sys = %s, out = %s\n" $(SRC_DIR) $(RES_DIR) $(SYS_DIR) $(DEST_DIR)
#	@echo System: $(SYSS)

pages: $(PHPS)
	@echo $(shell echo $(PHPS) | wc -w | xargs printf "%04d") pages were generated.

resources: $(O_RESS)
	@echo $(shell echo $(O_RESS) | wc -w | xargs printf "%04d") resources were linked.

system: $(O_SYSS)
	@echo $(shell echo $(O_SYSS) | wc -w | xargs printf "%04d") system resources were linked.

tags: $(TAGS)
	@echo $(shell echo $(TAGS) | wc -w | xargs printf "%04d") tag files were generated.

dbs: tags $(O_DBS) $(TOTAL_FILE)
	@echo $(shell echo $(O_DBS) | wc -w | xargs printf "%04d") database entries were generated.

#Dependency generation
$(DEP_DIR)%.dep: $(SRC_DIR)%.lyz
	@echo Generating dependencies for page $<
	@mkdir -p $(dir $@)
	@php5 -f $(LYZ_TO_DEP) $< $(patsubst $(SRC_DIR)%.lyz, $(DEST_DIR)%.php, $<) > $@

$(DEP_DIR)%.dep: $(SRC_DIR)%.pag
	@echo Generating dependencies for page $<
	@mkdir -p $(dir $@)
	@php5 -f $(LYZ_TO_DEP) $< $(patsubst $(SRC_DIR)%.pag, $(DEST_DIR)%.php, $<) > $@

#Tag generation
$(TAG_DIR)%.php: $(SRC_DIR)%.pag
	@echo Generating tags for page $@
	@mkdir -p $(dir $@)
	@php5 -f $(PAG_TO_TAG) $(SRC_DIR) $(DB_DIR) $< $@ $(MAP_FILE) $(CLOUD_FILE)

$(DB_DEP): $(TAGS)
	@echo Updating database dependencies
	@mkdir -p $(dir $@)
	@echo -n "$(DB_TOT):" > $@
	@for i in $$(find $(TAG_DIR) -type f ); do echo -n " $$i" >> $@; done && more $@

$(DB_TOT): $(DB_DEP) $(O_DBS)
	@echo Evaluating tag values
	@#for i in $(O_DBS); do php5 -f $(DBS_TO_TOT) $@ $$i; done

#File generation
$(DEST_DIR)%.php: $(SRC_DIR)%.lyz
	@echo Generating page $@
	@mkdir -p $(dir $@)
	@php5 -f $(LYZ_TO_PHP) $(SRC_DIR) $< > $@ || (more $@ && $(RM) $@ && return 1)

$(DEST_DIR)%.php: $(SRC_DIR)%.pag
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

$(DEST_DIR)%: $(IN_DIR)%
	@echo Linking database entry $@
	@mkdir -p $(dir $@)
	@$(LN_CMD) $< $@

#Cleaning
.PHONY: clean
clean:
	@$(RM) $(DEPS)
	@$(RM) $(PHPS)
	@$(RM) $(O_RESS)
	@$(RM) $(O_SYSS)
	@$(RM) -rf $(DEP_DIR) $(TAG_DIR) $(DB_DIR)

-include $(DEPS) $(DB_DEP)
