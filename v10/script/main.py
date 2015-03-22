#!/usr/bin/python
# encoding: utf-8

from __future__ import print_function
import sys

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

print('Siχtus 0.10')

import os
import fnmatch

pag_files = find_all_files ('src', '*.pag')

print('pag_files = %s' % pag_files)

print('Siχtus 0.10, done')
sys.exit(0)
