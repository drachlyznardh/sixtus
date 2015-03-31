#!/usr/bin/python
# -*- encoding: utf-8 -*-

from __future__ import print_function

class Poster:

	def __init__ (self, title, subtitle):

		self.title = title
		self.subtitle = subtitle

	def parse_files (self, list_files):

		for stem in list_files:
			self.side.append(stem[0])
			with open(stem[1], 'r') as f:
				self.page.append(f.read().strip())

with open(pag_file, 'w') as f:

	print('title|%s' % name_map['14'], file=f)
	print('subtitle|%s' % (name_map['15']), file=f)

	print('start|page', file=f)
	print('\nbr|\n'.join(page), file=f)

	print('start|side', file=f)
	print('stitle|%s' % name_map['14'], file=f)
	print('p|%s' % ('\n/\n'.join(['link||%s|%s' % (i, i) for i in side])), file=f)
