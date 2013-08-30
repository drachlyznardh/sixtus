
PREFIX := /opt/devel/web/sixtus/
LYZ_TO_PHP := $(PREFIX)transform/lyz-to-php.php

SRC_DIR := $(IN_DIR)src/
RES_DIR := $(IN_DIR)res/
SYS_DIR := $(IN_DIR)sys/
DEST_DIR := $(OUT_DIR)

LYZS := $(sort $(shell find $(SRC_DIR) -type f -name '*.lyz'))
SYSS := $(sort $(shell find $(SYS_DIR) -type f))
RESS := $(sort $(shell find $(RES_DIR) -type f))

PHPS := $(patsubst $(SRC_DIR)%.lyz, $(DEST_DIR)%.php, $(LYZS))
O_RESS := $(patsubst $(RES_DIR)%, $(DEST_DIR)%, $(RESS))
O_SYSS := $(patsubst $(SYS_DIR)%, $(DEST_DIR)%, $(SYSS))

all: pages resources system
#	@printf "in = %s, out = %s\n" $(IN_DIR) $(OUT_DIR)
#	@printf "src = %s, res = %s, sys = %s, out = %s\n" $(SRC_DIR) $(RES_DIR) $(SYS_DIR) $(DEST_DIR)
#	@echo System: $(SYSS)

pages: $(PHPS)
resources: $(O_RESS)
system: $(O_SYSS)

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
	@$(RM) $(PHPS)
	@$(RM) $(O_RESS)
	@$(RM) $(O_SYSS)
