
LYZS := $(sort $(shell find $(SRC_DIR) -name '*.lyz'))
PAGS := $(sort $(shell find $(SRC_DIR) -name '*.pag'))
SYSS := $(sort $(shell find $(SYS_DIR) -type f))
RESS := $(sort $(shell find $(RES_DIR) -type f))

PHPS   := $(patsubst $(SRC_DIR)%.lyz, $(DEST_DIR)%/page.php, $(LYZS))
PHPS   += $(patsubst $(SRC_DIR)%.pag, $(DEST_DIR)%/page.php, $(PAGS))
P_DEPS := $(patsubst $(SRC_DIR)%.lyz, $(DEP_DIR)%.dep, $(LYZS))
P_DEPS += $(patsubst $(SRC_DIR)%.pag, $(DEP_DIR)%.dep, $(PAGS))
TAGS   := $(patsubst $(SRC_DIR)%.pag, $(TAG_DIR)%.php, $(PAGS))
T_DEPS := $(TAGS:.php=.dep)
O_RESS := $(patsubst $(RES_DIR)%, $(DEST_DIR)%, $(RESS))
O_SYSS := $(patsubst $(SYS_DIR)%, $(DEST_DIR)%, $(SYSS))

all: deploy
deploy: pages

#-include $(P_DEPS) $(T_DEPS)

pages: $(PHPS)
resources: $(O_RESS)
system: $(O_SYSS) $(O_CLOUD_FILE) $(O_RMAP_FILE)

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
	@echo Generating tag reverse dependecy $<
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
$(DEST_DIR)%/page.php: $(SRC_DIR)%.lyz
	@echo Generating page $@ and contents from $<
	@mkdir -p $(patsubst %page.php, %, $@)
	@php5 -f $(LYZ_TO_PHP) $(SRC_DIR) $< $@ $(patsubst %page.php, %, $@) $(patsubst $(SRC_DIR)%.lyz, %, $<)

$(DEST_DIR)%/page.php: $(SRC_DIR)%.pag
	@echo Generating page $@ and contents from $<
	@mkdir -p $(dir $@)
	@php5 -f $(LYZ_TO_PHP) $(SRC_DIR) $< $@ $(patsubst %page.php, %, $@) $(patsubst $(SRC_DIR)%.pag, %, $<)

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

$(DEST_DIR)%.php: $(IN_DIR)%.php
	@echo Linking autogenerated source $@
	@$(LN_CMD) $< $@

#Cleaning
.PHONY: clean
clean:
	@$(RM) $(PHPS)
	@$(RM) $(O_RESS)
	@$(RM) $(O_SYSS)

