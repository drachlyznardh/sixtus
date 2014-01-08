
BLOG_DIR := $(SRC_DIR)blog/

POSTS   := $(sort $(shell find $(BLOG_DIR) -type f -name '*.post'))
MONTHS  := $(POSTS:.post=.lyz)
YEARS   := $(addsuffix index.lyz, $(sort $(dir $(MONTHS))))
ARCHIVE := $(BLOG_DIR)archive.lyz

all: months years archive

months: $(MONTHS)
	echo $(MONTHS)

years: $(YEARS)
	echo $(YEARS)

archive: $(ARCHIVE)
	echo $(ARCHIVE)

%.lyz: %.post
	@echo "\tGenerating blog page $< from $@"
	@mkdir -p $(dir $@)
	@php5 -f $(POST_TO_LYZ) $< $@

$(ARCHIVE):
	touch $@

%index.lyz:
	touch $@

.PHONY: clean
clean:
	$(RM) $(MONTHS)
	$(RM) $(YEARS)
	$(RM) $(ARCHIVE)
