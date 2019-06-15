
all: check test

check:
	@python3 setup.py check

test:
	@./test-all-samples.sh

install:
	@python3 setup.py install --user

syntax-install:
	@mkdir -p ~/.vim/syntax && install -m644 sixtus.vim ~/.vim/syntax/

completion-install:
	@mkdir -p ~/.config/sixtus && install -m644 sixtus.bash_completion ~/.config/sixtus/

clean:
	@$(RM) -rf dist/ build/

.PHONY: clean

