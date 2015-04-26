#!/bin/bash

sixtushome=`pwd`/src
PYTHONPATH=${sixtushome} python -m sixtus --version
targets="build rebuild veryclean"

for dir in samples/*; do
	pushd $dir > /dev/null
	PYTHONPATH=${sixtushome} python -m sixtus ${targets} > /dev/null
	if [ $? -eq 0 ]; then printf "%23s \x1b[32msucceded\x1b[m\n" $dir
	else printf "%23s \x1b[31mfailed\x1b[m\n" $dir; fi
	popd > /dev/null
done

