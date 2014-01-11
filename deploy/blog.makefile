
POST_TO_LYZ    := $(TRANSFORM)blog/post-to-lyz.php
CREATE_MAP     := $(TRANSFORM)blog/create-map.php
CREATE_YEAR    := $(TRANSFORM)blog/create-year.php
CREATE_ARCHIVE := $(TRANSFORM)blog/create-archive.php
CREATE_INDEX   := $(TRANSFORM)blog/create-index.php
UPDATE_MAP     := $(TRANSFORM)blog/update-blog-map.sh

BLOG_DIR := $(SRC_DIR)blog/
BLOG_MAP := $(BLOG_DIR)blog-map.php

POSTS   := $(sort $(shell find $(BLOG_DIR) -type f -name '*.post'))
MONTHS  := $(POSTS:.post=.lyz)
YEARS   := $(patsubst %/, %.lyz, $(sort $(dir $(MONTHS))))
ARCHIVE := $(BLOG_DIR)archivio.lyz
INDEX   := $(SRC_DIR)blog.lyz

all: months years archive
months: $(MONTHS)
years: $(YEARS)
archive: $(ARCHIVE)

$(BLOG_MAP): $(POSTS)
	@echo Generating blog map $@
	@$(PHP) -f $(CREATE_MAP) $@ $(BLOG_DIR)

%.lyz: %.post $(BLOG_MAP)
	@echo Generating blog page $@ from $<
	@mkdir -p $(dir $@)
	@php5 -f $(POST_TO_LYZ) $< $@ $(BLOG_MAP)

$(ARCHIVE): $(BLOG_MAP)
	@echo Generating archive page $@
	@$(PHP) -f $(CREATE_ARCHIVE) $@ $(BLOG_MAP)

$(INDEX): $(BLOG_MAP)
	@echo Generating index page $@
	@$(PHP) -f $(CREATE_INDEX) $@ $(BLOG_MAP)

%.lyz: $(BLOG_MAP)
	@echo Generating year page $@
	@$(PHP) -f $(CREATE_YEAR) $@ $(BLOG_MAP)

.PHONY: clean
clean:
	@echo Cleaning blog autogenerated files
	$(RM) $(MONTHS)
	$(RM) $(YEARS)
	$(RM) $(ARCHIVE)
	$(RM) $(BLOG_MAP)
