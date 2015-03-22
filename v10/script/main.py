#!/usr/bin/python
# encoding: utf-8

from __future__ import print_function
import sys

def get_all_dirs (source):

	found = []

	for each in os.listdir(source):
		child = os.path.join(source, each)
		if os.path.isdir(child):
			found.append(child)
			found += get_all_dirs(child)

	return found

print('Siχtus 0.10')

import os
import fnmatch

if not os.path.exists('src'):
	print('Path [src] does not exist!', file=sys.stderr)
	sys.exit(1)

visit = ['src'] + get_all_dirs('src')
print(visit)
pag_files = []

for d in visit:
	for i in os.listdir(d):

		print('Found [%s]' % i)

		if fnmatch.fnmatch(i, '*.pag'):
			print('%s matches *.pag' % i)
			pag_files.append(i)

print(pag_files)

print('Siχtus 0.10, done')
sys.exit(0)
