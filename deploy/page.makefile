
FRAGS := $(sort $(shell find $(FRAG_DIR) -name '*.frag'))
PAGES := $(patsubst $(FRAG_DIR)%.frag, $(DEST_DIR)%.php, $(FRAGS))

all: pages

pages: $(PAGES)

#File generation
$(DEST_DIR)%.php: $(FRAG_DIR)%.frag
	@echo Generating page $@ from $<
	@mkdir -p $(dir $@)
	@php5 -f $(FRAG_TO_PHP) $< $@

#Cleaning
.PHONY: clean
clean:
	@echo Cleaning pages
	@rm -rf $(PAGES)

