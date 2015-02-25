#!/usr/bin/python
# -*- encoding: utf-8 -*-

import sys
import re

class Poster:

	def __init__ (self, this_page, prev_page, next_page):

		self.this_page = this_page
		self.prev_page = prev_page
		self.next_page = next_page

		self.check = re.compile(r'^post#')

		self.content = ''
		self.post_map = {}
		self.current = False

	def store_content (self):

		if self.current:
			self.post_map[self.current] = self.content
		self.content = ''

	def append_content (self, text):

		if len(self.content):
			self.content += ('\n%s' % text)
		else: self.content = text

	def parse_file (self, filename):

		with open(filename) as f:
			for i in f:
				line = i.strip()

				if len(line) == 0:
					self.append_content(line)
					continue

				if line[0] == '#':
					self.append_content('')
					continue

				if self.check.match(line):

					token = line.split('#')
					size = len(token)

					self.store_content()
					self.current = token[1]

					self.append_content('tab#%s' % token[1])
					self.append_content('p#%s/%s/%02d' % (self.this_page[0], self.this_page[1], int(token[1])))
					if size == 4:
						self.append_content('/ %s' % token[3])
					if size > 4:
						self.append_content('/ %s &amp; %s' % (', '.join(token[3:-1]), token[-1]))
					self.append_content('title#%s' % token[2])
					continue

				self.append_content(line)

		self.store_content()

	def output_post_file (self, filename):

		print('title#%s %s' % (self.this_page[2], self.this_page[0]))
		#print('prev#%s%' % ())
		#print('next#%s%' % ())
		for number, value in self.post_map.items():
			print('%s' % value)
