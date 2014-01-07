
BLOG_DIR := $(SRC_DIR)blog/

POSTS := $(sort $(shell find $(BLOG_DIR) -type f -name '*.post'))
LYZS  := $(POSTS:.post=.lyz)

all: build
build: $(LYZS)

%.lyz: %.post
	@echo Generating blog page $< from $@
	@mkdir -p $(dir $@)
	@php5 -f $(POST_TO_LYZ) $< $@

.PHONY: clean deploy
clean:
deploy: build
