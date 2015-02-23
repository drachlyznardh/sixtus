#!/usr/bin/python
# -*- encoding: utf-8 -*-

from __future__ import print_function
import sys
import re

class Preprocessor:

	def __init__ (self, base):

		self.debug = False

		self.base = base
		self.origin_files = []

		self.filename = False
		self.lineno = 0
		self.inclusion = []
		self.content = []
		self.match = re.compile(r'^require#(.*)')
		self.extract = r'\1'

	def parse_file (self, filename):

		self.filename = filename
		self.origin_files.append(filename)
		self.lineno = 0

		with open(filename, 'r') as input_file:
			for line in input_file:
				self.lineno += 1
				self.parse_line(line.strip())

	def parse_line (self, line):

		if len(line) == 0: # Empty line
			self.content.append('')
			return

		if line[0] == '#': # Comment line
			self.content.append('')
			return

		if '#' not in line: # Plain content
			self.content.append(line)
			return

		if self.match.match(line): # Require directive
			target_name = self.match.sub(self.extract, line)
			target_file = '%s%s' % (self.base, target_name)
			self.inclusion.append((self.filename, self.lineno))
			self.content.append('source#%s#%d' % (target_name, 0))
			self.parse_file(target_file)
			self.filename, self.lineno = self.inclusion.pop()
			self.content.append('source#%s#%d' % (self.filename, self.lineno))
			return

		self.content.append(line) # Ordinany command
