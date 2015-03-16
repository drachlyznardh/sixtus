#!/usr/bin/python
# -*- encoding: utf-8 -*-

from __future__ import print_function
import re
import roman

def extract (filename):

	re_include = re.compile(r'^source\|(.*)\|.*\n$')
	re_tab     = re.compile(r'^tab\|(.*)\n$')

	sources = set()
	tabs = set()

	with open(filename, 'r') as f:
		for line in f.readlines():

			if re_include.match(line):
				sources.add(re_include.sub(r'\1', line))
			elif re_tab.match(line):
				tabs.add(re_tab.sub(r'\1', line))

	return list(sources), list(tabs)

def insert (filename, done, destination, sources, tabs):

	destination = roman.clear(destination)

	with open(filename, 'w') as f:

		if len(tabs) == 0:
			print('SIX_FILES += %sjump.six' % destination, file=f)
			print('%sjump.six: %s' % (destination, done), file=f)
			print('%s: %s' % (done, ' '.join(sources)), file=f)
			return

		files = ['%sjump.six' % destination]
		files.append('%sside.six' % destination)
		for tab in tabs:
			files.append('%s%s/page.six' % (destination, roman.convert(tab)))

		print('SIX_FILES += %s' % ' '.join(files), file=f)
		print('%s: %s' % (' '.join(files), done), file=f)
		print('%s: %s' % (done, ' '.join(sources)), file=f)
