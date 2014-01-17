
ACCS_TO_DMAP := $(TRANSFORM)maps/accs-to-dmap.php
ACCS_TO_CONF := $(TRANSFORM)maps/accs-to-conf.php
DMAP_TO_RMAP := $(TRANSFORM)maps/dmap-to-rmap.php

$(RUNTIME_CONF_FILE): $(ACCESS_MAP_FILE)
	@echo Generating runtime configuration file
	@mkdir -p $(dir $@)
	@$(PHP) -f $(ACCS_TO_CONF) $< $@

$(DIRECT_MAP_FILE): $(ACCESS_MAP_FILE)
	@echo Generating direct map file
	@mkdir -p $(dir $@)
	@$(PHP) -f $(ACCS_TO_DMAP) $< $@

$(REVERSE_MAP_FILE): $(DIRECT_MAP_FILE)
	@echo Generating reverse map file
	@mkdir -p $(dir $@)
	@$(PHP) -f $(DMAP_TO_RMAP) $< $@

maps-clean:
	@echo Cleaning map files
	@$(RM) $(RUNTIME_CONF_FILE) $(DIRECT_MAP_FILE) $(REVERSE_MAP_FILE)
