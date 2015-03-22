#!/usr/bin/python
# encoding: utf-8

from __future__ import print_function
import sys
import os
import fnmatch
import re

def find_all_dirs (source):

	found = []

	for each in os.listdir(source):
		child = os.path.join(source, each)
		if os.path.isdir(child):
			found.append(child)
			found += find_all_dirs(child)

	return found

def find_all_files (root_dir, pattern):

	if not os.path.exists(root_dir):
		print('Specified root_dir [%s] does not exist!' % root_dir, file=sys.stderr)
		sys.exit(1)

	visit = [root_dir] + find_all_dirs(root_dir)
	all_files = []

	for d in visit:
		for f in os.listdir(d):
			if fnmatch.fnmatch(f, pattern):
				all_files.append(os.path.join(d,f))

	return all_files

def assert_dir (filename):

	dirname = os.path.dirname(filename)

	if not os.path.exists(dirname):
		os.makedirs(dirname)

print('Siχtus 0.10')

pag_files = find_all_files ('src', '*.pag')
Six_files = [re.sub(r'^src(.*)\.pag$', r'build\1.Six', i) for i in pag_files]

print('pag_files = %s' % pag_files)
print('Six_files = %s' % Six_files)

for Six_file in Six_files:

	if not os.path.exists(Six_file):
		print('Six file [%s] does not exists!' % Six_file)
		pag_file = re.sub(r'^build(.*)\.Six$',r'src\1.pag', Six_file)
		page_base = os.path.dirname(pag_file)
		print('Invoking preprocessor %s %s %s' % (pag_file, page_base, Six_file))

		from preprocessor import Preprocessor
		pp = Preprocessor(page_base)
		pp.parse_file(pag_file)
		assert_dir(Six_file)
		pp.output_file(Six_file)

print('Siχtus 0.10, done')
sys.exit(0)
