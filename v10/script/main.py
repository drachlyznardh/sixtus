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

	visit = [root_dir] + find_all_dirs(root_dir)
	all_files = []

	for d in visit:
		for f in os.listdir(d):
			if fnmatch.fnmatch(f, pattern):
				all_files.append(f)

	return all_files

print('Siχtus 0.10')

import os
import fnmatch

if not os.path.exists('src'):
	print('Path [src] does not exist!', file=sys.stderr)
	sys.exit(1)

#visit = ['src'] + find_all_dirs('src')
#print(visit)
pag_files = find_all_files ('src', '*.pag')

#for d in visit:
#	for i in os.listdir(d):
#
#		print('Found [%s]' % i)
#
#		if fnmatch.fnmatch(i, '*.pag'):
#			print('%s matches *.pag' % i)
#			pag_files.append(i)

print(pag_files)

print('Siχtus 0.10, done')
sys.exit(0)
