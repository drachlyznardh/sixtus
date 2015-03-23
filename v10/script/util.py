#!/usr/bin/python
# encoding: utf-8

from __future__ import print_function
import os
import fnmatch

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

def get_six_filename (bundle):

	extension = ['page.six', 'jump.six', 'side.six']
	return os.path.join(bundle[1], extension[bundle[0]])

def get_php_filename (bundle):

	extension = ['index.php', 'index.php', 'side.php']
	return os.path.join(bundle[1], extension[bundle[0]])

