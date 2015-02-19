
PAGS := $(sort $(shell find $(SRC_DIR) -name '*.pag'))
DEPS := $(patsubst $(SRC_DIR)%.pag, $(DEP_DIR)%.dep, $(PAGS))
TCHS := $(patsubst $(SRC_DIR)%.pag, $(TCH_DIR)%.frag.tch, $(PAGS))

all: touches

ifneq ($(MAKECMDGOALS),clean)
-include $(DEPS)
endif

touches: $(TCHS)

#Dependency generation
$(DEP_DIR)%.dep: $(SRC_DIR)%.pag
	@echo Generating dependencies for page $<
	@mkdir -p $(dir $@)
	@php5 -f $(PAG_TO_DEP) $< $(SRC_DIR) $(patsubst $(SRC_DIR)%.pag, $(TCH_DIR)%.tch, $<) $@

### Fragment generation
$(TCH_DIR)%.frag.tch: $(SRC_DIR)%.pag
	@echo Splitting up $< info fragments
	@mkdir -p $(patsubst $(TCH_DIR)%.frag.tch, $(FRAG_DIR)%/, $@)
	php5 -f $(PAG_TO_FRAG) $< $(SRC_DIR) $(patsubst $(TCH_DIR)%.frag.tch, $(FRAG_DIR)%/, $@)
	@touch $@

#Cleaning
.PHONY: clean
clean:
	@echo Cleaning fragments
	@rm -rf $(TCHS)
	@rm -rf $(DEP_DIR)

