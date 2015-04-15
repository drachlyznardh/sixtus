# -*- encoding: utf-8 -*-

from __future__ import print_function

class Helper:
	def __init__ (self):
		self.content = ''
		self.post = {}
		self.title = {}
		self.current = False

	def store_content (self):
		if self.current in self.post:
			self.post[self.current].append(self.content)
		elif self.current:
			self.post[self.current] = [self.content]

		self.content = ''

	def append_content (self, text):
		if len(self.content):
			self.content += '\n%s' % text
		else: self.content = text

	def parse_file (self, filename):
		lineno = 0
		for i in open(filename, 'r'):
			lineno += 1
			line = i.strip()

			if len(line) == 0:
				self.append_content(line)
				continue

			if line.startswith('#'):
				self.append_content('')
				continue

			if line.startswith('post|'):
				token = line.split('|')
				size = len(token)

				if size < 3:
					print('On file %s at line %d: %s' % (filename, lineno, i))
					raise Exception('A post must have a number and a title')

				self.store_content()
				self.current = token[1]

				if size == 4:
					self.append_content('/ %s' % token[3].capitalize())
				if size > 4:
					self.append_content('/ %s &amp; %s' % (', '.join(w.capitalize() for w in token[3:-1]), token[-1].capitalize()))

				self.append_title(token[1], token[2])
				self.append_content('title|%s' % token[2])
				continue

			self.append_content(line)

		self.store_content()

class Poster:

	def __init__ (self, home):

		self.home = home

	def parse_line (self, line):

		if not line.startswith('link|'): return

		token = line.split('|')
		self.post_url = token[1]
		self.post_hash = token[3]

	def parse_target (self, list_file):

		with open(list_file, 'r') as f:
			for line in f.readlines():
				self.parse_line(line.strip())

	def output_pag_file (self, pag_file):

		content = 'jump|%s#%s' % (self.post_url, self.post_hash)

		with open(pag_file, 'w') as f:
			print(content, file=f)
