SIXTUS_RUNTIME_IN_DIR := $(SIXTUS_DIR)runtime/
SIXTUS_RUNTIME_OUT_DIR := $(DEPLOY_DIR)sixtus/

SIXTUS_RUNTIME_FILES += style.css icon.ico panel.js
SIXTUS_RUNTIME_FILES += page-top.php page-middle.php page-bottom.php

SIXTUS_RUNTIME_OUT_FILES += $(addprefix $(SIXTUS_RUNTIME_OUT_DIR), $(SIXTUS_RUNTIME_FILES))

sixtus-runtime: $(SIXTUS_RUNTIME_OUT_FILES)

$(SIXTUS_RUNTIME_OUT_DIR)%: $(SIXTUS_RUNTIME_IN_DIR)%
	@cp $< $@
	@echo page component [$@] copied

SITE_TOP_PARAMS += $(SITE_AUTHOR)
SITE_TOP_PARAMS += $(SITE_TAB_PREV_BEFORE) $(SITE_TAB_PREV_LINK) $(SITE_TAB_PREV_AFTER)

$(SIXTUS_RUNTIME_OUT_DIR)page-top.php: $(SIXTUS_RUNTIME_IN_DIR)page-head.php.in
	@$(SCRIPT_DIR)page-make-top.sh $< $@ $(SITE_TOP_PARAMS)
	@echo page top [$@] generated

SITE_MIDDLE_PARAMS += $(SITE_COPYRIGHT_YEARS) $(SITE_COPYRIGHT_OWNER)
SITE_MIDDLE_PARAMS += $(SITE_TAB_NEXT_BEFORE) $(SITE_TAB_NEXT_LINK) $(SITE_TAB_NEXT_AFTER)
SITE_MIDDLE_PARAMS += $(SITE_PAGE_PREV) $(SITE_PAGE_NEXT)

$(SIXTUS_RUNTIME_OUT_DIR)page-middle.php: $(SIXTUS_RUNTIME_IN_DIR)page-neck.php.in $(SIXTUS_RUNTIME_IN_DIR)page-left-side.php.in $(SIXTUS_RUNTIME_IN_DIR)page-knee.php.in
	@$(SCRIPT_DIR)page-make-middle.sh $^ $@ $(SITE_MIDDLE_PARAMS)
	@echo page middle [$@] generated

$(SIXTUS_RUNTIME_OUT_DIR)page-bottom.php: $(SIXTUS_RUNTIME_IN_DIR)page-foot.php.in
	@$(SCRIPT_DIR)page-make-bottom.sh $< $@
	@echo page bottom [$@] generated
