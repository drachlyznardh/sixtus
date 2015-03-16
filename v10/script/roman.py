#/usr/bin/python
# -*- encoding: utf-8 -*-

import re

test = re.compile(r'''^(m{0,3})(cm|cd|d?c{0,3})(xc|xl|l?x{0,3})(ix|iv|v?i{0,3})$''')
index = re.compile(r'(.*)/Index$')

def convert (name):

	if test.match(name): return name.upper()
	if name.islower(): return name.capitalize()
	return name

def clear (name):

	if index.match(name):
		return index.sub(r'\1', name)
	return name
