
all: check test

check:
	@python3 setup.py check

test:
	@./test-all-samples.sh

install:
	@python3 setup.py install --user

clean:
	@$(RM) -rf dist/ build/

.PHONY: clean

