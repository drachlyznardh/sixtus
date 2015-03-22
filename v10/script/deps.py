#!/usr/bin/python
# -*- encoding: utf-8 -*-

from __future__ import print_function
import re
import os

import roman

def extract (filename):

	re_include = re.compile(r'^source\|(.*)\|.*\n$')
	re_tab     = re.compile(r'^tab\|(.*)\n$')
	re_jump    = re.compile(r'^jump\|(.*)\n$')

	sources = []
	tabs = []

	with open(filename, 'r') as f:
		for line in f.readlines():

			if re_include.match(line):
				sources.append(re_include.sub(r'\1', line))
			elif re_tab.match(line):
				tabs.append(re_tab.sub(r'\1', line))
			elif re_jump.match(line):
				return True, sources, tabs

	return False, roman.unique(sources), roman.unique(tabs)

def rreplace (name):

	k = name.rfind('/')
	return '%s%%%s' % (name[:k], name[k+1:])

def insert (dep_file, Six_file, destination, jump, sources, tabs):

	d = '%s/' % os.path.normpath(destination)
	_d = os.path.normpath(destination)

	size = len(tabs)

	if jump:
		files = ['%sjump.six' % d]
		names = ['jump']
	elif size == 0:
		files = ['%spage.six' % d]
		names = ['page']
	elif size == 1:
		files = ['%s%s/page.six' % (d, roman.convert(tabs[0]))]
		files.append('%sjump.six' % d)
		names = ['page', 'jump']
	else:
		files = ['%s%s/page.six' % (d, roman.convert(name)) for name in tabs ]
		files.append('%sjump.six' % d)
		files.append('%sside.six' % d)
		names = ['%s/page' % roman.convert(name) for name in tabs]
		names.append('jump')
		names.append('side')


	with open(dep_file, 'w') as f:
		print('SIX_FILES += %s' % ' '.join(files), file=f)
		print('SIX_DIRS += %s' % d, file=f)
		#print('%s: %s' % (' '.join(files), ' '.join(sources)), file=f)
		#print('%s: %s' % (' '.join(['%s%%%s.six' % (_d, name) for name in names]), ' '.join([rreplace(i) for i in sources])), file=f)
		print('%s: %s' % (' '.join(['%s%%%s.six' % (_d, name) for name in names]), Six_file), file=f)
		print('\t@echo -n "Splitting source file %s… [$*]… "' % Six_file, file=f)
		print('\t@$(SCRIPT_DIR)Six-to-six %s %s' % (Six_file, d), file=f)
		print('\t@echo "Done"', file=f)
