
#LYZS := $(sort $(shell find $(SRC_DIR) -name '*.lyz'))
PAGS := $(sort $(shell find $(SRC_DIR) -name '*.pag'))

#PHPS := $(patsubst $(SRC_DIR)%.lyz, $(DEST_DIR)%/page.php, $(LYZS))
PHPS := $(patsubst $(SRC_DIR)%.pag, $(DEST_DIR)%/page.php, $(PAGS))
#DEPS := $(patsubst $(SRC_DIR)%.lyz, $(DEP_DIR)%.dep, $(LYZS))
DEPS := $(patsubst $(SRC_DIR)%.pag, $(DEP_DIR)%.dep, $(PAGS))

all: pages

ifneq ($(MAKECMDGOALS),clean)
-include $(DEPS)
endif

pages: $(PHPS)

#Dependency generation
$(DEP_DIR)%.dep: $(SRC_DIR)%.lyz
	@echo Generating dependencies for page $<
	@mkdir -p $(dir $@)
	@php5 -f $(LYZ_TO_DEP) $< $(patsubst $(SRC_DIR)%.lyz, $(DEST_DIR)%.php, $<) > $@

$(DEP_DIR)%.dep: $(SRC_DIR)%.pag
	@echo Generating dependencies for page $<
	@mkdir -p $(dir $@)
	@php5 -f $(LYZ_TO_DEP) $< $(patsubst $(SRC_DIR)%.pag, $(DEST_DIR)%.php, $<) $@

#File generation
$(DEST_DIR)%/page.php: $(SRC_DIR)%.lyz
	@echo Generating page $@ and contents from $<
	@mkdir -p $(patsubst %page.php, %, $@)
	@php5 -f $(LYZ_TO_PHP) $(SRC_DIR) $< $@ $(patsubst %page.php, %, $@) $(patsubst $(SRC_DIR)%.lyz, %, $<)

$(DEST_DIR)%/page.php: $(SRC_DIR)%.pag
	@echo Generating page $@ and contents from $<
	@mkdir -p $(dir $@)
	@php5 -f $(LYZ_TO_PHP) $(SRC_DIR) $< $@ $(patsubst %page.php, %, $@) $(patsubst $(SRC_DIR)%.pag, %, $<)

STUFF := $(shell find $(DEST_DIR) -name 'page.php')
STUFF += $(shell find $(DEST_DIR) -name 'content.php')
STUFF += $(shell find $(DEST_DIR) -name 'right-side.php')
STUFF += $(shell find $(DEST_DIR) -name 'tab-*.php')

#Cleaning
.PHONY: clean
clean:
	@echo Cleaning pages
	@$(RM) $(PHPS)
	@$(RM) $(DEPS)
	@$(RM) $(STUFF)

