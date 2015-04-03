#!/usr/bin/python
# encoding: utf-8

from __future__ import print_function
import os
import re
import fnmatch

test = re.compile(r'''^(m{0,3})(cm|cd|d?c{0,3})(xc|xl|l?x{0,3})(ix|iv|v?i{0,3})$''')
index = re.compile(r'(.*)/Index')

def find_all_sources (root_dir, pattern, nameonly):

	if not os.path.exists(root_dir):
		raise Exception('Root dir %s does not exist' % root_dir)

	visit = ['']
	result = []
	re_pattern = re.compile(pattern)

	while len(visit):
		this_dir = visit.pop(0)
		for each in os.listdir(os.path.join(root_dir, this_dir)):
			this_name = os.path.join(root_dir, this_dir, each)
			if os.path.isdir(this_name):
				visit.append(os.path.join(this_dir, each))
			elif re_pattern.match(this_name):
				this_file = os.path.join(this_dir, each)
				if nameonly:
					result.append(os.path.splitext(this_file)[0])
				else: result.append(this_file)
	return result

def assert_dir (filename):

	dirname = os.path.dirname(filename)

	if not os.path.exists(dirname):
		os.makedirs(dirname)

def convert (name):

	if test.match(name): return name.upper()
	if name.islower(): return name.capitalize()
	return name

def unique (origin):

	seen = set()
	f = seen.add
	return [x for x in origin if x and not (x in seen or f(x))]

