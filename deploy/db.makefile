
SRCS := $(sort $(shell find $(SRC_DIR) -name '*.pag'))
TCHS := $(SRCS:.pag=.tch)

PAG_TO_CLOUD = $(PHP) -f $(PREFIX)transform/pag-to-cloud.php

DB_DIR     := $(DEST_DIR)runtime/db/
CLOUD_FILE := $(DB_DIR)cloud.php

all: $(TCHS) $(CLOUD_FILE)
$(COULD_FILE): $(TCHS)

%.tch: %.pag
	@echo Generating tags for page $<
	@$(PAG_TO_CLOUD) $< $(patsubst $(SRC_DIR)%.pag, %, $<) $(REVERSE_MAP_FILE) $(DB_DIR)

.PHONY: clean
clean:
	@echo Cleaning database
	@$(RM) $(TCHS)
	@$(RM) $(CLOUD_FILE)
