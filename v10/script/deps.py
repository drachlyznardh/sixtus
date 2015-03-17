#!/usr/bin/python
# -*- encoding: utf-8 -*-

from __future__ import print_function
import re
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
				return True, [], []

	return False, roman.unique(sources), roman.unique(tabs)

def insert (filename, destination, jump, sources, tabs):

	destination = roman.clear(destination)

	with open(filename, 'w') as f:

		if jump:

			print('SIX_FILES += %sjump.six' % destination, file=f)
			print('%sjump.six: %s.done' % (destination, destination), file=f)
			print('%s.done: %s' % (destination, ' '.join(sources)), file=f)
			return

		if len(tabs) == 0:

			print('SIX_FILES += %spage.six' % destination, file=f)
			print('%spage.six: %s.done' % (destination, destination), file=f)
			print('%s.done: %s' % (destination, ' '.join(sources)), file=f)
			return

		files = ['%sjump.six' % destination]
		files.append('%sside.six' % destination)
		for tab in tabs:
			files.append('%s%s/page.six' % (destination, roman.convert(tab)))

		print('SIX_FILES += %s' % ' '.join(files), file=f)
		print('%s: %s.done' % (' '.join(files), destination), file=f)
		print('%s.done: %s' % (destination, ' '.join(sources)), file=f)
