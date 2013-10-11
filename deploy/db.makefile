
DBES := $(sort $(shell find $(DB_DIR) -type f -name '*.tag'))
TCHS := $(DBES:=.tch)

all: $(CLOUD_FILE)

%.tch: %
	@echo $@ comes from $<
	@touch $@
	@php5 -f $(TCH_TO_CLOUD) $< $(CLOUD_FILE)

$(CLOUD_FILE): $(TCHS)
	@echo Updating database…
	@touch $@
