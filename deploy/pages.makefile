
PAGS := $(sort $(shell find $(SRC_DIR) -name '*.pag'))
PHPS := $(patsubst $(SRC_DIR)%.pag, $(DEST_DIR)%/page.php, $(PAGS))
DEPS := $(patsubst $(SRC_DIR)%.pag, $(DEP_DIR)%.dep, $(PAGS))

FRAG_DIRS := $(patsubst $(SRC_DIR)%.pag, $(TMP_DIR)%/, $(PAGS))
FRAG_TCHS := $(addsuffix .tch, $(FRAG_DIRS))

all: pages

ifneq ($(MAKECMDGOALS),clean)
-include $(DEPS)
endif

pages: metas $(PHPS)
metas: $(FRAG_DIRS) $(FRAG_TCHS)

#Dependency generation
$(DEP_DIR)%.dep: $(SRC_DIR)%.pag
	@echo Generating dependencies for page $<
	@mkdir -p $(dir $@)
	@php5 -f $(LYZ_TO_DEP) $< $(SRC_DIR) $(patsubst $(SRC_DIR)%.pag, $(DEST_DIR)%/page.php, $<) $@

#File generation
$(DEST_DIR)%/page.php: $(SRC_DIR)%.pag
	@echo Generating page $@ and contents from $<
	@mkdir -p $(dir $@)
	@php5 -f $(LYZ_TO_PHP) $(SRC_DIR) $< $@ $(patsubst %page.php, %, $@) $(patsubst $(SRC_DIR)%.pag, %, $<)

### Fragment generation
$(TMP_DIR)%:
	@mkdir -p $(dir $@)

$(TMP_DIR)%/.tch: $(SRC_DIR)%.pag
	@echo Splitting up $< info fragments in $@
	@mkdir -p $(dir $@)
	@php5 -f $(PAG_TO_FRAG) $< $(patsubst %.tch, %, $@)
	@touch $@

STUFF := $(shell find $(DEST_DIR) -name 'page.php')
STUFF += $(shell find $(DEST_DIR) -name 'content.php')
STUFF += $(shell find $(DEST_DIR) -name 'right-side.php')
STUFF += $(shell find $(DEST_DIR) -name 'tab-*.php')

#Cleaning
.PHONY: clean
clean:
	@echo Cleaning pages
	@$(RM) $(PHPS)
	@$(RM) $(DEP_DIR)
	@$(RM) $(STUFF)

