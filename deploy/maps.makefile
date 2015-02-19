
ACCS_TO_DMAP := $(TRANSFORM)maps/accs-to-dmap.php
ACCS_TO_CONF := $(TRANSFORM)maps/accs-to-conf.php
ACCS_TO_RSLV := $(TRANSFORM)maps/accs-to-resolve.php
DMAP_TO_RMAP := $(TRANSFORM)maps/dmap-to-rmap.php

sixtus-map: $(RUNTIME_CONF_FILE) $(DIRECT_MAP_FILE) $(RESOLVE_FILE) $(REVERSE_MAP_FILE)

$(RUNTIME_CONF_FILE): $(ACCESS_MAP_FILE)
	@echo Generating runtime configuration file
	@mkdir -p $(dir $@)
	@$(PHP) -f $(ACCS_TO_CONF) $< $@

$(DIRECT_MAP_FILE): $(ACCESS_MAP_FILE)
	@echo Generating direct map file
	@mkdir -p $(dir $@)
	@$(PHP) -f $(ACCS_TO_DMAP) $< $@

$(RESOLVE_FILE): $(ACCESS_MAP_FILE)
	@echo Generating resolve file
	@mkdir -p $(dir $@)
	@$(PHP) -f $(ACCS_TO_RSLV) $< $@

$(REVERSE_MAP_FILE): $(DIRECT_MAP_FILE)
	@echo Generating reverse map file
	@mkdir -p $(dir $@)
	@$(PHP) -f $(DMAP_TO_RMAP) $< $@

sixtus-map-clean:
	@echo Cleaning map files
	@$(RM) $(RUNTIME_CONF_FILE) $(DIRECT_MAP_FILE) $(RESOLVE_FILE) $(REVERSE_MAP_FILE)
