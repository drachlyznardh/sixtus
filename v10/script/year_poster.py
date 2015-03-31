#!/usr/bin/python
# -*- encoding: utf-8 -*-

from __future__ import print_function

class Poster:

	def __init__ (self, this_year, prev_year, next_year, names, subtitle):

		self.this_year = this_year
		self.prev_year = prev_year
		self.next_year = next_year

		self.names = names
		self.subtitle = subtitle

		self.page = []
		self.side = []

	def parse_files (self, list_files):

		for stem in list_files:
			self.side.append(stem[0])
			with open(stem[1], 'r') as f:
				self.page.append(f.read().strip())

	def output_pag_file (self, pag_file):

		with open(pag_file, 'w') as f:

			print('title|%s' % self.this_year, file=f)
			print('subtitle|%s' % (self.subtitle % self.this_year), file=f)

			if self.prev_year:
				print('prev|Blog/%s/|%s' % (self.prev_year, self.prev_year), file=f)
			if self.next_year:
				print('next|Blog/%s/|%s' % (self.next_year, self.next_year), file=f)

			print('start|page', file=f)
			print('\nbr|\n'.join(self.page), file=f)

			print('start|side', file=f)
			print('title|%s' % self.this_year, file=f)
			for i in self.side:
				print('p|link||%s|%s-%s' % (self.names[i], self.this_year, i), file=f)

	def output_list_file (self, list_file):

		with open(list_file, 'w') as f:

			print('id|%s' % self.this_year, file=f)
			print('stitle|link|Blog/%s/|%s' % (self.this_year, self.this_year), file=f)
			for i in xrange(3):
				line = []
				for j in xrange(4):
					index = 1 + i * 4 + j
					number = '%02d' % index
					name = self.names[number]
					if number in self.side:
						line.append('link|Blog/%s/%s/|%s' % (self.this_year, number, name))
					else: line.append('%s' % name)
				print('c|%s' % ('\n/\n'.join(line)), file=f)

