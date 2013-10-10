
DBES := $(sort $(shell find $(DB_DIR) -type f -name '*.php'))
TCHS := $(DBES:=.tch)

all: $(CLOUD_FILE)
	@echo Hello!
	@echo Tagging from $(IN_DIR) to $(OUT_DIR)
	@echo Database \($(DB_DIR)\) entries { $(DBES) }
	@echo HCKS { $(TCHS) }

%.tch: %
	@echo $@ comes from $<
	@touch $@

$(CLOUD_FILE): $(TCHS)
	@echo Updating database…
	@touch $@
