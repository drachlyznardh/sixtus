
export CP  := cp
export PHP := php5
export RM  := rm -rf

export LYZ_TO_PHP   := $(PREFIX)transform/lyz-to-php.php
export LYZ_TO_DEP   := $(PREFIX)transform/lyz-to-dep.php
export TAG_TO_DEP   := $(PREFIX)transform/tag-to-dep.php
export PAG_TO_TAG   := $(PREFIX)transform/pag-to-tag.php
export DBS_TO_TOT   := $(PREFIX)transform/dbs-to-tot.php
export TAG_TO_DBE   := $(PREFIX)transform/tag-to-dbe.php
export DMAP_TO_RMAP := $(PREFIX)transform/dmap-to-rmap.php
export POST_TO_LYZ  := $(PREFIX)transform/post-to-lyz.php
export TCH_TO_CLOUD := $(PREFIX)transform/tch-to-cloud.php

export SRC_DIR  := $(IN_DIR)src/
export RES_DIR  := $(IN_DIR)res/
export SYS_DIR  := $(IN_DIR)sys/
export DEP_DIR  := $(IN_DIR).dep/
export TAG_DIR  := $(IN_DIR).tag/
export DB_DIR   := $(IN_DIR).db/
export DEST_DIR := $(OUT_DIR)

### Map files
export ACCESS_MAP_FILE  := $(IN_DIR)access-map.php
export DIRECT_MAP_FILE  := $(DEST_DIR)runtime/direct-map.php
export REVERSE_MAP_FILE := $(DEST_DIR)runtime/reverse-map.php

