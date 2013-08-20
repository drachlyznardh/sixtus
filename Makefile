
LYZ_TO_PHP := /opt/devel/web/sixtus/transform/lyz-to-php.php

OBJS := $(sort $(patsubst src/%.lyz, web/%.php, $(shell find src/ -name '*.lyz')))
IMGS := $(sort $(patsubst src/%, web/%, $(shell find src/ -name '*.jpg' -o -name '*.gif' -o -name '*.png')))
PDFS := $(sort $(patsubst src/%, web/%, $(shell find src/ -name '*.pdf')))

all: pages images pdfs

pages: $(OBJS)

images: $(IMGS)

pdfs: $(PDFS)

web/%.php: src/%.lyz
	@echo "[$< => $@]"
	@mkdir -p $(dir $@)
	@php5 -f $(LYZ_TO_PHP) $< > $@ || (more $@ && $(RM) $@ && return 1)

web/%.pdf: src/%.pdf
	@echo "[$< => $@]"
	@mkdir -p $(dir $@)
	@cp $< $@

web/%.png: src/%.png
	@echo "[$< => $@]"
	@mkdir -p $(dir $@)
	@cp $< $@

web/%.jpg: src/%.jpg
	@echo "[$< => $@]"
	@mkdir -p $(dir $@)
	@cp $< $@

web/%.gif: src/%.gif
	@echo "[$< => $@]"
	@mkdir -p $(dir $@)
	@cp $< $@

.PHONY: clean

clean:
	$(RM) $(OBJS)
	
