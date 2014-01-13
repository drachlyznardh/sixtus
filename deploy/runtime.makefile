
RUNTIME_IN_DIR  := $(PREFIX)runtime/
RUNTIME_OUT_DIR := $(DEST_DIR)runtime/

SOURCE_FILES  := $(sort $(shell find $(RUNTIME_IN_DIR) -type f))
RUNTIME_FILES := $(patsubst $(RUNTIME_IN_DIR)%, $(RUNTIME_OUT_DIR)%, $(SOURCE_FILES))

all: deploy
deploy: $(RUNTIME_FILES)

$(RUNTIME_OUT_DIR)%: $(RUNTIME_IN_DIR)%
	@echo Linking runtime file $@
	@mkdir -p $(dir $@)
	@$(CP) $< $@

.PHONY: clean
clean:
	@echo Cleaning runtime files
	@$(RM) $(RUNTIME_FILES)
