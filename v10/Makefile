
SITE_AUTHOR          := "Ivan Simonini &lt;drachlyznardh@gmail.com&gt;"
SITE_COPYRIGHT_YEARS := "2007-2015"
SITE_COPYRIGHT_OWNER := "Ivan Simonini"
SITE_KEYWORD_PREV    := "Precendente"
SITE_KEYWORD_NEXT    := "Successivo"

SIXTUS_DIR := /opt/devel/web/sixtus/v10/
CMD_DIR := $(SIXTUS_DIR)deploy/
DEPLOY_DIR := /opt/web/mobile/

SIXTUS_IN_DIR := $(SIXTUS_DIR)runtime/
SIXTUS_OUT_DIR := $(DEPLOY_DIR)sixtus/

SIXTUS_RUNTIME_IN_FILES := $(shell find $(SIXTUS_IN_DIR) -name '*.css')
SIXTUS_RUNTIME_IN_FILES += $(shell find $(SIXTUS_IN_DIR) -name '*.ico')
SIXTUS_RUNTIME_IN_FILES += $(shell find $(SIXTUS_IN_DIR) -name '*.php')

SIXTUS_RUNTIME_FILES += style.css icon.ico
SIXTUS_RUNTIME_FILES += page-top.php page-middle.php page-bottom.php

SIXTUS_RUNTIME_OUT_FILES += $(addprefix $(SIXTUS_OUT_DIR), $(SIXTUS_RUNTIME_FILES))

sixtus_runtime: $(SIXTUS_RUNTIME_OUT_FILES)
	@echo $(SIXTUS_RUNTIME_IN_FILES)
	@echo $(SIXTUS_RUNTIME_FILES)
	@echo $(SIXTUS_RUNTIME_OUT_FILES)


#$(SIXTUS_RUNTIME_OUT_FILES): $(SIXTUS_OUT_DIR)%: $(SIXTUS_IN_DIR)%
$(SIXTUS_OUT_DIR)%: $(SIXTUS_IN_DIR)%
	@echo Default copy $(CP) $< $@

$(SIXTUS_OUT_DIR)page-top.php: $(SIXTUS_IN_DIR)page-head.php.in
	$(CMD_DIR)make-page-top.sh $< $@ $(SITE_AUTHOR)

$(SIXTUS_OUT_DIR)page-middle.php: $(SIXTUS_IN_DIR)page-neck.php.in $(SIXTUS_IN_DIR)page-knee.php.in
	@echo $(CP) $< $@

$(SIXTUS_OUT_DIR)page-bottom.php: $(SIXTUS_IN_DIR)page-foot.php.in
	@echo $(CP) $< $@

