
PREFIX := /opt/devel/web/sixtus/
export LYZ_TO_PHP   := $(PREFIX)transform/lyz-to-php.php
export LYZ_TO_DEP   := $(PREFIX)transform/lyz-to-dep.php
export TAG_TO_DEP   := $(PREFIX)transform/tag-to-dep.php
export PAG_TO_TAG   := $(PREFIX)transform/pag-to-tag.php
export DBS_TO_TOT   := $(PREFIX)transform/dbs-to-tot.php
export TAG_TO_DBE   := $(PREFIX)transform/tag-to-dbe.php
export MAP_TO_RMAP  := $(PREFIX)transform/map-to-rmap.php
export POST_TO_LYZ  := $(PREFIX)transform/post-to-lyz.php
export TCH_TO_CLOUD := $(PREFIX)transform/tch-to-cloud.php

export SRC_DIR  := $(IN_DIR)src/
export RES_DIR  := $(IN_DIR)res/
export SYS_DIR  := $(IN_DIR)sys/
export DEP_DIR  := $(IN_DIR).dep/
export TAG_DIR  := $(IN_DIR).tag/
export DB_DIR   := $(IN_DIR).db/
export DEST_DIR := $(OUT_DIR)

export CLOUD_FILE   := $(IN_DIR).cloud.php
export O_CLOUD_FILE := $(patsubst $(IN_DIR)%, $(DEST_DIR)%, $(CLOUD_FILE))
export MAP_FILE     := $(IN_DIR)sys/sys/runtime.php
export RMAP_FILE    := $(IN_DIR).rmap.php
export O_RMAP_FILE  := $(patsubst $(IN_DIR)%, $(DEST_DIR)%, $(RMAP_FILE))

all: content
	@$(MAKE) -f $(PREFIX)/deploy/deploy.makefile

content: db blog
	@$(MAKE) -f $(PREFIX)/deploy/content.makefile

blog:
	@$(MAKE) -f $(PREFIX)/deploy/blog.makefile

db:
	@$(MAKE) -f $(PREFIX)/deploy/db.makefile

#Cleaning
.PHONY: clean
clean:
	@$(MAKE) -f $(PREFIX)/deploy/deploy.makefile clean
	@$(MAKE) -f $(PREFIX)/deploy/content.makefile clean
	@$(MAKE) -f $(PREFIX)/deploy/blog.makefile clean
	@$(MAKE) -f $(PREFIX)/deploy/db.makefile clean

