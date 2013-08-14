
LYZ_TO_PHP := /opt/devel/web/sixtus/transform/lyz-to-php.php

SRCS := $(shell find src/ -name '*.lyz')
OBJS := $(sort $(patsubst src/%.lyz, web/%.php, $(SRCS)))

all: $(OBJS)

print:
	@echo $(SRCS)
	@echo $(OBJS)

web/%.php: src/%.lyz
	@echo "[$< => $@]"
	@mkdir -p $(dir $@)
	@php5 -f $(LYZ_TO_PHP) $< > $@ || (more $@ && $(RM) $@ && return 1)

.PHONY: clean

clean:
	$(RM) $(OBJS)
	
