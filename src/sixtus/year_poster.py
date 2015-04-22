# -*- encoding: utf-8 -*-

from __future__ import print_function

from .util import assert_dir

class Poster:

	def __init__ (self, home, this_year, prev_year, next_year):

		self.home = home

		self.this_year = this_year
		self.prev_year = prev_year
		self.next_year = next_year

		self.page = []
		self.side = []

	def apply_values (self, fmt):

		result = fmt.replace('@THIS_YEAR@', self.this_year or '')
		result = result.replace('@PREV_YEAR@', self.prev_year or '')
		return result.replace('@NEXT_YEAR@', self.next_year or '')

	def parse_conf (self, conf):

		year_conf = conf['lang']['blog']['year']
		self.title = self.apply_values(year_conf['title'])
		self.subtitle = self.apply_values(year_conf['subtitle'])

		archive_conf = conf['lang']['blog']['archive']
		self.archive = archive_conf['title']

		self.names = conf['lang']['month']

	def parse_files (self, list_files):

		for stem in list_files:
			self.side.append(stem[0])
			with open(stem[1], 'r') as f:
				self.page.append(f.read().strip())

	def output_pag_file (self, pag_file):

		output = 'title|%s\n' % self.title
		output += 'subtitle|%s\n' % self.subtitle

		if self.prev_year:
			destination = '%s/%s/' % (self.home, self.prev_year)
			output += 'prev|%s|%s\n' % (destination, self.prev_year)

		if self.next_year:
			destination = '%s/%s/' % (self.home, self.next_year)
			output += 'next|%s|%s\n' % (destination, self.next_year)

		output += 'start|page\n'
		output += '%s\n' % '\nbr|\n'.join(self.page)

		output += 'start|side\n'
		output += 'c|link|%s/%s/|%s\n' % (self.home, self.archive, self.archive)
		output += 'title@center|%s\n'  % self.this_year

		for i in xrange(4):
			line = []
			for j in xrange(3):
				month = '%02d' % (1 + j + 3 * i)
				name = self.names[month]
				if month in self.side:
					ref = '%s-%s' % (self.this_year, month)
					line.append('link||%s|%s' % (name, ref))
				else: line.append(name)
			output += 'c|%s\n' % '\n/\n'.join(line)

		assert_dir(pag_file)
		with open(pag_file, 'w') as f:
			print(output, file=f)

	def output_list_file (self, list_file):

		output = 'id|%s\n' % self.this_year

		destination = '%s/%s/' % (self.home, self.this_year)
		output += 'stitle@center|link|%s|%s\n' % (destination, self.this_year)

		for i in xrange(4):
			line = []
			for j in xrange(3):
				month = '%02d' % (1 + j + 3 * i)
				name = self.names[month]
				if month in self.side:
					destination = '%s/%s/%s/' % (self.home, self.this_year, month)
					line.append('link|%s|%s' % (destination, name))
				else: line.append(name)
			output += 'c|%s\n' % '\n/\n'.join(line)

		assert_dir(list_file)
		with open(list_file, 'w') as f:
			print(output, file=f)
