
PAGS := $(sort $(shell find $(SRC_DIR) -name '*.pag'))
TAGS := $(patsubst $(SRC_DIR)%.pag, $(TAG_DIR)%.php, $(PAGS))

IN_DBES  := $(sort $(shell find $(IN_DB_DIR) -type f -name '*.tag'))
OUT_DBES := $(patsubst $(IN_DB_DIR)%, $(OUT_DB_DIR)%, $(IN_DBES))

TCHS   := $(IN_DBES:=.tch)

all: $(CLOUD_FILE) $(OUT_DBES)

$(TAG_DIR)%.php: $(SRC_DIR)%.pag $(REVERSE_MAP_FILE)
	@echo Generating tags for page $<
	@mkdir -p $(dir $@)
	@php5 -f $(PAG_TO_TAG) $(SRC_DIR) $(DB_DIR) $< $@ $(REVERSE_MAP_FILE)

%.tch: %
	@echo Updating database for entry $<
	@touch $@
	@php5 -f $(TCH_TO_CLOUD) $< $(CLOUD_FILE)

$(CLOUD_FILE): $(TCHS)
	@echo Updating database…
	@touch $@

$(OUT_DB_DIR)%.tag: $(IN_DB_DIR)%.tag
	@echo Linking database entry $@
	@mkdir -p $(dir $@)
	@$(CP) $< $@

.PHONY: clean
clean:
	@echo Cleaning database
	@$(RM) $(OUT_DBES)
	@$(RM) $(CLOUD_FILE)
