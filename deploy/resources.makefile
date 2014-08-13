
RES_IDIR := $(IN_DIR)res/
RES_ODIR := $(OUT_DIR)

IFILES := $(sort $(shell (if [ -d $(RES_IDIR) ]; then find $(RES_IDIR) -type f -or -type l; fi)))
OFILES := $(patsubst $(RES_IDIR)%, $(RES_ODIR)%, $(IFILES))

deploy: $(OFILES)

$(RES_ODIR)%: $(RES_IDIR)%
	@echo Linking runtime file $@
	@mkdir -p $(dir $@)
	@$(CP) $< $@

.PHONY: clean
clean:
	@echo Cleaning resources
	@$(RM) $(OFILES)
