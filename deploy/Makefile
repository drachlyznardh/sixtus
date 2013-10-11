
PREFIX := /opt/devel/web/sixtus/
LYZ_TO_PHP  := $(PREFIX)transform/lyz-to-php.php
LYZ_TO_DEP  := $(PREFIX)transform/lyz-to-dep.php
TAG_TO_DEP  := $(PREFIX)transform/tag-to-dep.php
PAG_TO_TAG  := $(PREFIX)transform/pag-to-tag.php
DBS_TO_TOT  := $(PREFIX)transform/dbs-to-tot.php
TAG_TO_DBE  := $(PREFIX)transform/tag-to-dbe.php
MAP_TO_RMAP := $(PREFIX)transform/map-to-rmap.php
export TCH_TO_CLOUD := $(PREFIX)transform/tch-to-cloud.php

export SRC_DIR  := $(IN_DIR)src/
export RES_DIR  := $(IN_DIR)res/
export SYS_DIR  := $(IN_DIR)sys/
export DEP_DIR  := $(IN_DIR).dep/
export TAG_DIR  := $(IN_DIR).tag/
export DB_DIR   := $(IN_DIR).db/
export DEST_DIR := $(OUT_DIR)

export CLOUD_FILE := $(IN_DIR).cloud.php
export MAP_FILE   := $(IN_DIR)sys/sys/runtime.php
export RMAP_FILE  := $(IN_DIR).rmap.php

LYZS := $(sort $(shell find $(SRC_DIR) -name '*.lyz'))
PAGS := $(sort $(shell find $(SRC_DIR) -name '*.pag'))
SYSS := $(sort $(shell find $(SYS_DIR) -type f))
RESS := $(sort $(shell find $(RES_DIR) -type f))

PHPS   := $(patsubst $(SRC_DIR)%.lyz, $(DEST_DIR)%.php, $(LYZS))
PHPS   += $(patsubst $(SRC_DIR)%.pag, $(DEST_DIR)%.php, $(PAGS))
P_DEPS   := $(patsubst $(SRC_DIR)%.lyz, $(DEP_DIR)%.dep, $(LYZS))
P_DEPS   += $(patsubst $(SRC_DIR)%.pag, $(DEP_DIR)%.dep, $(PAGS))
TAGS   := $(patsubst $(SRC_DIR)%.pag, $(TAG_DIR)%.php, $(PAGS))
T_DEPS := $(TAGS:.php=.dep)
O_RESS := $(patsubst $(RES_DIR)%, $(DEST_DIR)%, $(RESS))
O_SYSS := $(patsubst $(SYS_DIR)%, $(DEST_DIR)%, $(SYSS))

#all: $(P_DEPS) pages resources system tags dbes
all: deploy
deploy: content tagging
content: pages resources system
tagging: tags db

-include $(P_DEPS) $(T_DEPS)

db: $(TAGS)
	@$(MAKE) -f /opt/devel/web/sixtus/deploy/db.makefile
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

#Dependency generation
$(DEP_DIR)%.dep: $(SRC_DIR)%.lyz
	@echo Generating dependencies for page $<
	@mkdir -p $(dir $@)
	@php5 -f $(LYZ_TO_DEP) $< $(patsubst $(SRC_DIR)%.lyz, $(DEST_DIR)%.php, $<) > $@

$(DEP_DIR)%.dep: $(SRC_DIR)%.pag
	@echo Generating dependencies for page $<
	@mkdir -p $(dir $@)
	@php5 -f $(LYZ_TO_DEP) $< $(patsubst $(SRC_DIR)%.pag, $(DEST_DIR)%.php, $<) > $@

$(TAG_DIR)%.dep: $(TAG_DIR)%.php
	@echo Generating tag reverse dependecy $< $@
	@php5 -f $(TAG_TO_DEP) $< $@ $(DB_DIR)

#Tag generation
$(TAG_DIR)%.php: $(SRC_DIR)%.pag $(RMAP_FILE)
	@echo Generating tags for page $<
	@mkdir -p $(dir $@)
	@php5 -f $(PAG_TO_TAG) $(SRC_DIR) $(DB_DIR) $< $@ $(RMAP_FILE)

$(RMAP_FILE): $(MAP_FILE)
	@echo Generating reverse map
	@php5 -f $(MAP_TO_RMAP) $< $@

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
	@$(RM) $(PHPS)
	@$(RM) $(O_RESS)
	@$(RM) $(O_SYSS)

