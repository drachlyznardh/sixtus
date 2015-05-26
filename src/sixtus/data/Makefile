
TEX := @TEX@
SRCS := $(TEX)
SRCS += $(wildcard @DIR@/*.tex)
PDF := $(TEX:.tex=.pdf)

.PHONY:clean,veryclean
all: $(PDF)

$(PDF):$(SRCS)
	xelatex $(TEX)
	xelatex $(TEX)

clean:
	$(RM) *.aux *.log *.out *.toc

veryclean: clean
	$(RM) -r $(SRCS) @DIR@ Makefile
