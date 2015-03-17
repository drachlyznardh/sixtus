IN_DIR := $(SIXTUS_DIR)/runtime
OUT_DIR := $(DEPLOY_DIR)/sixtus

IN_FILES += style.css icon.ico panel.js
IN_FILES += page-top.php page-middle.php page-bottom.php

OUT_FILES += $(addprefix $(OUT_DIR)/, $(IN_FILES))

all: sixtus-runtime
sixtus-runtime: $(OUT_FILES)
$(OUT_FILES): $(SITE_CONF_FILE) | $(OUT_DIR)

$(OUT_DIR):
	@mkdir -p $@

$(OUT_DIR)%: $(IN_DIR)%
	@echo -n "Copying page component $@… "
	@cp $< $@
	@echo Done

$(OUT_DIR)page-top.php: $(IN_DIR)page-head.php.in
	@echo -n "Generating page top section $@… "
	@$(SCRIPT_DIR)page-make-top $(filter %.php.in, $^) $@ \
		$(SITE_AUTHOR) \
		$(SITE_TAB_PREV_BEFORE) $(SITE_TAB_PREV_LINK) $(SITE_TAB_PREV_AFTER)
	@echo Done

$(OUT_DIR)page-middle.php: $(IN_DIR)page-neck.php.in \
		$(IN_DIR)page-left-side.php.in $(IN_DIR)page-knee.php.in
	@echo -n "Generating page middle section $@… "
	@$(SCRIPT_DIR)page-make-middle $(filter %.php.in, $^) $@ \
		$(SITE_COPYRIGHT_YEARS) $(SITE_COPYRIGHT_OWNER) \
		$(SITE_TAB_NEXT_BEFORE) $(SITE_TAB_NEXT_LINK) $(SITE_TAB_NEXT_AFTER) \
		$(SITE_PAGE_PREV) $(SITE_PAGE_NEXT)
	@echo Done

$(OUT_DIR)page-bottom.php: $(IN_DIR)page-foot.php.in
	@echo -n "Generating page bottom section $@… "
	@$(SCRIPT_DIR)page-make-bottom $(filter %.php.in, $^) $@
	@echo Done

.PHONY: clean sixtus-runtime-clean
clean: sixtus-runtime-clean
sixtus-runtime-clean:
	@echo -n "Cleaning runtime files… "
	@rm -f $(OUT_FILES)
	@echo Done
