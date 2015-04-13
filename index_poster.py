#!/usr/bin/python
# -*- encoding: utf-8 -*-

from __future__ import print_function

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
