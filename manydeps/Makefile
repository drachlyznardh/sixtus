
I_PAG := $(sort $(shell find src/ -name '*.pag'))

O_TAG := $(patsubst src/%.pag, tag/%.tag, $(I_PAG))
O_PAG := $(patsubst src/%.pag, pag/%.php, $(I_PAG))

DB_DEP := db/db_total.dep
DB_TOT := db/db_total.php

all: pages tags $(DB_TOT)

pages: $(O_PAG)

tags: $(O_TAG)

pag/%.php: src/%.pag
	@echo Generating page $<
	@mkdir -p $(dir $@)
	@magic/pag-to-php $< $@

tag/%.tag: src/%.pag
	@echo Extracting tag info from page $<
	@mkdir -p $(dir $@)
	@magic/pag-to-tag $< $@

%.hack: %.tag
	@echo $< $@ → $(DB_TOT)
	@touch $@

$(DB_TOT): $(O_TAG:.tag=.hack)
	@echo Evaluating database total values $^
	@mkdir -p $(dir $@)
	@touch $@
	@rm tag/*.hack

-include $(DB_DEP)

#db/%dep: src/%.

clean:
	$(RM) -rf tag/ db/ pag/ $(DB_DEP)

.PHONY: clean
