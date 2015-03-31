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

	def output_pag_file (self, pag_file):

		with open(pag_file, 'w') as f:

			print('title|%s' % self.title, file=f)
			print('subtitle|%s' % self.subtitle, file=f)

			print('start|page', file=f)
			print('\nbr|\n'.join(self.page), file=f)

			print('start|side', file=f)
			print('stitle|%s' % self.title, file=f)
			print('p|%s' % ('\n/\n'.join(['link||%s|%s' % (i, i) for i in self.side])), file=f)
