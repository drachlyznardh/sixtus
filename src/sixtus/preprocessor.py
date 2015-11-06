# -*- encoding: utf-8 -*-

from __future__ import print_function
import sys
import os
import re

class Preprocessor:

	def __init__ (self, base, debug):

		self.debug = debug

		self.base = base
		self.sources = []

		self.filename = False
		self.lineno = 0
		self.inclusion = []
		self.content = []
		self.re_require = re.compile(r'^require\|(.*)')
		self.extract = r'\1'
		self.re_open_close_style = re.compile(r'^([^{]*){([^\|]*)\|([^}]*)}(.*)$')
		self.re_open_style = re.compile(r'^([^{]*){([^\|]*)\|(.*)$')
		self.re_close_style = re.compile(r'^([^}]*)}(.*)$')

		self.style_is_active = False
		self.style_command = ''
		self.style_content = []

	def clean_line (self, line):

		line = line.strip()
		line = line.replace('@PIPE@','&#124;')
		line = line.replace('@AT@','&#64;')
		return line

	def parse_file (self, filename):

		if self.debug: print('Preproccessor: now parsing file %s' % filename)

		self.filename = filename
		self.sources.append(filename)
		self.lineno = 0

		self.content.append('source|%s|%d' % (filename, 0))

		try:
			with open(filename, 'r') as input_file:
				for line in input_file:
					self.lineno += 1
					self.parse_line(self.clean_line(line))
		except EnvironmentError as e:
			print('\nPreprocessor could not open %s: %s' % (filename, e.strerror), file=sys.stderr)
			sys.exit(1)

	def get_existing_path (self, base, required):

		trial = base

		while trial != '/':

			target = os.path.join(trial, required)
			if os.path.exists(target):
				return target

			trial = os.path.dirname(trial)

		print('Cannot find %s anywhere from %s' % (required, base), file=sys.stderr)
		sys.exit(1)

	def parse_line (self, line):

		if len(line) == 0: # Empty line
			self.content.append('')
			return

		if line[0] == '#': # Comment line
			self.content.append('')
			return

		if '|' not in line: # Plain content
			if self.style_is_active: self.style_content += line
			else: self.content.append(line)
			return

		if self.re_require.match(line): # Require directive
			target_name = self.re_require.sub(self.extract, line)
			target_file = self.get_existing_path(self.base, target_name)
			self.inclusion.append((self.filename, self.lineno))
			self.parse_file(target_file)
			self.filename, self.lineno = self.inclusion.pop()
			self.content.append('source|%s|%d' % (self.filename, self.lineno))
			return

		if self.style_is_active and self.re_close_style.match(line):
			content = self.re_close_style.sub(r'\1', line)
			remainder = self.re_close_style.sub(r'\2', line)
			self.style_content.append(content)
			self.content.append('%s|%s' % (self.style_command,
				' '.join(self.style_content)))

			self.style_content = []
			line = remainder
			self.style_is_active = False

		while self.re_open_close_style.match(line):
			before = self.re_open_close_style.sub(r'\1', line)
			command = self.re_open_close_style.sub(r'\2', line)
			content = self.re_open_close_style.sub(r'\3', line)
			after = self.re_open_close_style.sub(r'\4', line)

			self.content.append(before)
			self.content.append('%s|%s' % (command, content))
			line = after

		if self.re_open_style.match(line):
			before = self.re_open_style.sub(r'\1', line)
			command = self.re_open_style.sub(r'\2', line)
			content = self.re_open_style.sub(r'\3', line)

			self.content.append(before)
			self.style_command = command
			self.style_content.append(content)
			self.style_is_active = True
			return

		self.content.append(line) # Ordinany command

	def output_Six_file (self, Six_file):
		if not Six_file: pass
		with open(Six_file, 'w') as f:
			for line in self.content:
				print(line, file=f)

	def output_src_file (self, src_file):
		if not src_file: return self.sources
		with open(src_file, 'w') as f:
			print(self.sources, file=f)
		return self.sources

