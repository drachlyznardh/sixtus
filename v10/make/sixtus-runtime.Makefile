SIXTUS_RUNTIME_IN_DIR := $(SIXTUS_DIR)runtime/
SIXTUS_RUNTIME_OUT_DIR := $(DEPLOY_DIR)sixtus/

SIXTUS_RUNTIME_FILES += style.css icon.ico panel.js
SIXTUS_RUNTIME_FILES += page-top.php page-middle.php page-bottom.php

SIXTUS_RUNTIME_OUT_FILES += $(addprefix $(SIXTUS_RUNTIME_OUT_DIR), $(SIXTUS_RUNTIME_FILES))

sixtus-runtime: $(SIXTUS_RUNTIME_OUT_FILES)
$(SIXTUS_RUNTIME_OUT_FILES): $(SITE_CONF_FILE)

$(SIXTUS_RUNTIME_OUT_DIR)%: $(SIXTUS_RUNTIME_IN_DIR)%
	@cp $< $@
	@echo page component [$@] copied

$(SIXTUS_RUNTIME_OUT_DIR)page-top.php: $(SIXTUS_RUNTIME_IN_DIR)page-head.php.in
	$(SCRIPT_DIR)page-make-top $(filter %.php.in, $^) $@ \
		$(SITE_AUTHOR) \
		$(SITE_TAB_PREV_BEFORE) $(SITE_TAB_PREV_LINK) $(SITE_TAB_PREV_AFTER)
	@echo page top [$@] generated

$(SIXTUS_RUNTIME_OUT_DIR)page-middle.php: $(SIXTUS_RUNTIME_IN_DIR)page-neck.php.in \
		$(SIXTUS_RUNTIME_IN_DIR)page-left-side.php.in $(SIXTUS_RUNTIME_IN_DIR)page-knee.php.in
	$(SCRIPT_DIR)page-make-middle $(filter %.php.in, $^) $@ \
		$(SITE_COPYRIGHT_YEARS) $(SITE_COPYRIGHT_OWNER) \
		$(SITE_TAB_NEXT_BEFORE) $(SITE_TAB_NEXT_LINK) $(SITE_TAB_NEXT_AFTER) \
		$(SITE_PAGE_PREV) $(SITE_PAGE_NEXT)
	@echo page middle [$@] generated

$(SIXTUS_RUNTIME_OUT_DIR)page-bottom.php: $(SIXTUS_RUNTIME_IN_DIR)page-foot.php.in
	$(SCRIPT_DIR)page-make-bottom $(filter %.php.in, $^) $@
	@echo page bottom [$@] generated

.PHONY: sixtus-runtime-clean
sixtus-runtime-clean:
	@echo -n "Cleaning runtime files… "
	@rm -f $(SIXTUS_RUNTIME_OUT_FILES)
	@echo Done
