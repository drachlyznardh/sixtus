
export CP  := cp
export PHP := php5
export RM  := rm -rf

export TRANSFORM := $(PREFIX)transform/

export LYZ_TO_PHP   := $(PREFIX)transform/lyz-to-php.php
export LYZ_TO_DEP   := $(PREFIX)transform/lyz-to-dep.php
export TAG_TO_DEP   := $(PREFIX)transform/tag-to-dep.php
export PAG_TO_TAG   := $(PREFIX)transform/pag-to-tag.php
export PAG_TO_FRAG  := $(TRANSFORM)pag-to-frag.php
export DBS_TO_TOT   := $(PREFIX)transform/dbs-to-tot.php
export TAG_TO_DBE   := $(PREFIX)transform/tag-to-dbe.php
export TCH_TO_CLOUD := $(PREFIX)transform/tch-to-cloud.php

export SRC_DIR  := $(IN_DIR)src/
export RES_DIR  := $(IN_DIR)res/
export SYS_DIR  := $(IN_DIR)sys/
export DEP_DIR  := $(IN_DIR).dep/
export TAG_DIR  := $(IN_DIR).tag/
export IN_DB_DIR   := $(IN_DIR).db/

export DEST_DIR := $(OUT_DIR)
export TMP_DIR  := /tmp/sixtus$(shell echo $(IN_DIR) | sed -e 's/\//-/g')tmp/

export RUNTIME_DIR := $(PREFIX)runtime/

### Map files
export ACCESS_MAP_FILE   := $(IN_DIR)access-map.php
export DIRECT_MAP_FILE   := $(DEST_DIR)runtime/direct-map.php
export RUNTIME_CONF_FILE := $(DEST_DIR)runtime/conf.php
export RESOLVE_FILE      := $(DEST_DIR)runtime/resolve.php
export REVERSE_MAP_FILE  := $(DEST_DIR)runtime/reverse-map.php

