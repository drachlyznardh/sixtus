
SOURCE_FILES  := $(sort $(shell find $(RUNTIME_DIR) -type f))
RUNTIME_FILES := $(patsubst $(RUNTIME_DIR), $(DEST_DIR), $(SOURCE_FILES))

all: deploy

deploy: $(RUNTIME_FILES)
	@echo Deploying runtime files
	@echo {$(RUNTIME_DIR)}
	@echo {$(SOURCE_FILES)}
	@echo {$(RUNTIME_FILES)}

$(DEST_DIR)%: $(RUNTIME_DIR)%
	@echo Linking runtime file $@
	@mkdir -p $(dir $@)
	@$(LN_CMD) $< $@

.PHONY: clean
clean:
	@$(RM) $(RUNTIME_FILES)
