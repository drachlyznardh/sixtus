#!/usr/bin/python
# -*- encoding: utf-8 -*-

from __future__ import print_function
import re

class Poster:

	def __init__ (self, home, this_page, prev_page, next_page):

		self.home = home

		self.this_page = this_page
		self.prev_page = prev_page
		self.next_page = next_page

		self.check = re.compile(r'^post\|')

		self.content = ''
		self.post_content = {}
		self.post_title = {}
		self.current = False

	def store_content (self):

		if self.current in self.post_content.keys():
			self.post_content[self.current].append(self.content)
		elif self.current:
			self.post_content[self.current] = [self.content]

		self.content = ''

	def append_title (self, number, title):

		if number in self.post_title.keys():
			self.post_title[number].append(title)
		else: self.post_title[number] = [title]

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

					token = line.split('|')
					size = len(token)

					self.store_content()
					try: self.current = token[1]
					except: raise Exception('(%s), (%s)' % (line, token))

					if size == 4:
						self.append_content('/ %s' % token[3].capitalize())
					if size > 4:
						self.append_content('/ %s &amp; %s' % (', '.join(w.capitalize() for w in token[3:-1]), token[-1].capitalize()))

					self.append_title(token[1], token[2])
					self.append_content('title|%s' % token[2])
					continue

				self.append_content(line)

		self.store_content()

	def output_pag_file (self, filename):

		with open(filename, 'w') as f:
			print('title|%s %s' % (self.this_page[2], self.this_page[0]), file=f)
			if self.prev_page:
				print('prev|%s/%s/%s/|%s %s' % (self.home, self.prev_page[0], self.prev_page[1], self.prev_page[2], self.prev_page[0]), file=f)
			if self.next_page:
				print('next|%s/%s/%s/|%s %s' % (self.home, self.next_page[0], self.next_page[1], self.next_page[2], self.next_page[0]), file=f)
			print('start|side', file=f)
			print('stitle|%s %s' % (self.this_page[2], self.this_page[0]), file=f)
			for number, value in self.post_title.items():
				print('p|<code>%s/%s</code> – ' % (number, self.this_page[1]), file=f)
				print('\n&amp;\n'.join(['link||%s|%s-%s' % (value[i], number, i) for i in xrange(len(value))]), file=f)
			print('start|page', file=f)
			manydays = False
			for number, value in sorted(self.post_content.items()):
				if manydays: print('br|', file=f)
				else: manydays = True
				manyposts = False
				for index in xrange(len(value)):
					if manyposts: print('br|', file=f)
					else: manyposts = True
					print('id|%s-%s' % (number, index), file=f)
					print('p|link||%s/%s/%02d|%02d-%d' % (self.this_page[0], self.this_page[1], int(number), int(number), index), file=f)
					print('%s' % value[index], file=f)

	def output_list_file (self, filename):

		this_url = 'Blog/%s/%s/' % (self.this_page[0], self.this_page[1])

		with open(filename, 'w') as f:
			print('id|%s-%s' % (self.this_page[0], self.this_page[1]), file=f)
			print('stitle|link|Blog/%s/%s/|%s %s' % (self.this_page[0], self.this_page[1], self.this_page[2], self.this_page[0]), file=f)
			for number, value in sorted(self.post_title.items()):
				print('p|<code>%s/%s</code> – ' % (number, self.this_page[1]), file=f)
				print('\n&amp;\n'.join(['link|%s|%s|%s/%s' % (this_url, value[i], number, i) for i in xrange(len(value))]), file=f)
