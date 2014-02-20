
POST_TO_PAG    := $(TRANSFORM)blog/post-to-pag.php
POST_TO_FRAG   := $(TRANSFORM)blog/post-to-frag.php
CREATE_MAP     := $(TRANSFORM)blog/create-map.php
CREATE_YEAR    := $(TRANSFORM)blog/create-year.php
CREATE_ARCHIVE := $(TRANSFORM)blog/create-archive.php
CREATE_NEWS    := $(TRANSFORM)blog/create-news.php
UPDATE_MAP     := $(TRANSFORM)blog/update-blog-map.sh

BLOG_ODIR := $(FRAG_DIR)blog/
BLOG_MAP  := $(BLOG_ODIR)map.php

POSTS   := $(sort $(shell find $(BLOG_DIR) -type f -name '*.post'))
MONTHS  := $(patsubst $(BLOG_DIR)%.post, $(BLOG_ODIR)%.month, $(POSTS))
YEARS   := $(patsubst %/, %.pag, $(sort $(dir $(MONTHS))))
ARCHIVE := $(BLOG_DIR)archivio.pag
NEWS    := $(abspath $(BLOG_DIR)../blog.pag)

all: blog

blog:
	@echo Blog generated from $(BLOG_DIR) to $(BLOG_ODIR)

blog: blog-map months years archive news
months: $(MONTHS)
years: $(YEARS)
archive: $(ARCHIVE)
news: $(NEWS)
blog-map: $(BLOG_MAP)

$(BLOG_MAP): $(POSTS)
	@echo Generating blog map $@
	@mkdir -p $(dir $@)
	@$(PHP) -f $(CREATE_MAP) $@ $(BLOG_DIR)

$(BLOG_ODIR)%.month: $(BLOG_DIR)%.post #blog-map
	@echo Extracting fragments from $<
	@mkdir -p $(basename $@)/
	@php5 -f $(POST_TO_FRAG) $< $@ $(BLOG_MAP) $(basename $@)/
	@touch $@

%.pag: %.post $(BLOG_MAP)
	@echo Generating blog page $@ from $<
	@mkdir -p $(dir $@)
	@php5 -f $(POST_TO_PAG) $< $@ $(BLOG_MAP)

$(ARCHIVE): $(BLOG_MAP)
	@echo Generating archive page $@
	@$(PHP) -f $(CREATE_ARCHIVE) $@ $(BLOG_MAP)

$(NEWS): $(BLOG_MAP)
	@echo Generating news page $@
	@$(PHP) -f $(CREATE_NEWS) $@ $(BLOG_MAP) $(BLOG_DIR)

%.pag: $(BLOG_MAP)
	@echo Generating year page $@
	@$(PHP) -f $(CREATE_YEAR) $@ $(BLOG_MAP)

.PHONY: clean
clean:
	@echo Cleaning blog autogenerated files
	$(RM) $(MONTHS)
	$(RM) $(YEARS)
	$(RM) $(ARCHIVE)
	$(RM) $(BLOG_MAP)
