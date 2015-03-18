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

def insert (filename, destination, jump, sources, tabs):

	d = '%s/' % os.path.normpath(destination)

	size = len(tabs)

	if jump:
		files = ['sjump.six' % d]
	elif size == 0:
		files = ['spage.six' % d]
	elif size == 1:
		files = ['s%s/page.six' % (d, roman.convert(tabs[0]))]
		files.append('%sjump.six' % d)
	else:
		files = ['%s%s/page.six' % (d, roman.convert(name)) for name in tabs ]
		files.append('%sjump.six' % d)
		files.append('%sside.six' % d)

	with open(filename, 'w') as f:

		if jump:

			print('SIX_FILES += %sjump.six' % d, file=f)
			print('SIX_DIRS += %s' % d, file=f)
			print('%sjump.six: %s.done' % (d, d), file=f)
			print('%s.done: %s' % (d, ' '.join(sources)), file=f)
			return

		size = len(tabs)

		if size == 0:

			print('SIX_FILES += %spage.six' % d, file=f)
			print('SIX_DIRS += %s' % d, file=f)
			print('%spage.six: %s.done' % (d, d), file=f)
			print('%s.done: %s' % (d, ' '.join(sources)), file=f)
			return

		if size == 1:

			files = []
			files.append('%s%s/page.six' % (d, roman.convert(tabs[0])))
			files.append('%sjump.six' % d)

			print('SIX_FILES += %s' % ' '.join(files), file=f)
			print('SIX_DIRS += %s' % d, file=f)
			print('%s: %s.done' % (' '.join(files), d), file=f)
			print('%s.done: %s' % (d, ' '.join(sources)), file=f)
			return

		files = ['%s%s/page.six' % (d, roman.convert(name)) for name in tabs ]
		files.append('%sjump.six' % d)
		files.append('%sside.six' % d)

		print('SIX_FILES += %s' % ' '.join(files), file=f)
		print('SIX_DIRS += %s' % d, file=f)
		print('%s: %s.done' % (' '.join(files), d), file=f)
		print('%s.done: %s' % (d, ' '.join(sources)), file=f)
