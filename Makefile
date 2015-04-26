
all: check test

run:
	@PYTHONPATH=src python -m sixtus

check:
	@python setup.py check

test:
	@./test-all-samples.sh

dist:
	@python setup.py sdist

install:
	@python setup.py install

