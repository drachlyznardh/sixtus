
RESOURCES_IN_DIR  := $(IN_DIR)res/
RESOURCES_OUT_DIR := $(OUT_DIR)

IN_FILES  := $(sort $(shell find $(RESOURCES_IN_DIR) -type f))
OUT_FILES := $(patsubst $(RESOURCES_IN_DIR)%, $(RESOURCES_OUT_DIR)%, $(IN_FILES))

all: deploy
deploy: $(OUT_FILES)

$(RESOURCES_OUT_DIR)%: $(RESOURCES_IN_DIR)%
	@echo Linking runtime file $@
	@mkdir -p $(dir $@)
	@$(CP) $< $@

.PHONY: clean
clean:
	@echo Cleaning resources
	@$(RM) $(OUT_FILES)
