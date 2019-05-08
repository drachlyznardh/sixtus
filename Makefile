
all: check test

check:
	@python setup.py check

test:
	@./test-all-samples.sh

install:
	@python setup.py install

clean:
	@$(RM) -rf dist/ build/

.PHONY: clean

