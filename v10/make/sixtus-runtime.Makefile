SIXTUS_RUNTIME_IN_DIR := $(SIXTUS_DIR)runtime/
SIXTUS_RUNTIME_OUT_DIR := $(DEPLOY_DIR)sixtus/

SIXTUS_RUNTIME_FILES += style.css icon.ico
SIXTUS_RUNTIME_FILES += page-top.php page-middle.php page-bottom.php

SIXTUS_RUNTIME_OUT_FILES += $(addprefix $(SIXTUS_RUNTIME_OUT_DIR), $(SIXTUS_RUNTIME_FILES))

sixtus_runtime: $(SIXTUS_RUNTIME_OUT_FILES)

$(SIXTUS_RUNTIME_OUT_DIR)%: $(SIXTUS_RUNTIME_IN_DIR)%
	@cp $< $@
	@echo page component [$@] copied

$(SIXTUS_RUNTIME_OUT_DIR)page-top.php: $(SIXTUS_RUNTIME_IN_DIR)page-head.php.in
	@$(CMD_DIR)make-page-top.sh $< $@ $(SITE_AUTHOR)
	@echo page top [$@] generated

$(SIXTUS_RUNTIME_OUT_DIR)page-middle.php: $(SIXTUS_RUNTIME_IN_DIR)page-neck.php.in $(SIXTUS_RUNTIME_IN_DIR)page-left-side.php.in $(SIXTUS_RUNTIME_IN_DIR)page-knee.php.in
	@$(CMD_DIR)make-page-middle.sh $^ $@ $(SITE_COPYRIGHT_YEARS) $(SITE_COPYRIGHT_OWNER) $(SITE_KEYWORD_PREV) $(SITE_KEYWORD_NEXT)
	@echo page middle [$@] generated

$(SIXTUS_RUNTIME_OUT_DIR)page-bottom.php: $(SIXTUS_RUNTIME_IN_DIR)page-foot.php.in
	@$(CMD_DIR)make-page-bottom.sh $< $@
	@echo page bottom [$@] generated
