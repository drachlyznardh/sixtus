#!/usr/bin/python
# -*- encoding: utf-8 -*-

from __future__ import print_function
import sys
import os

class Splitter:

	def __init__ (self, base):

		self.verbose = False
		self.debug   = False

		self.base = base

		self.state = 'meta'

		self.meta    = ''
		self.side    = ''
		self.content = ''

		self.jump    = False
		self.first   = False
		self.tabname = None

		self.tabs  = {}
		self.prevs = {}
		self.nexts = {}

		self.filename = ''
		self.lineno = 0
		self.touch_files = []

	def update_state (self, newstate):

		if self.state == 'meta':
			self.meta += self.content
		elif self.state == 'side':
			self.side += self.content
		elif self.state == 'page':
			self.tabs[self.tabname] = self.content

		self.state = newstate
		self.content = ''

	def split_content (self, lines):

		for line in lines:

			self.lineno += 1
			if self.debug: print(line)

			if len(line) and line[0] == '#':
				if self.debug: print('Line is a comment, skip')
				continue

			if '#' not in line:
				self.append_content(line)
				if self.debug: print('Line is simple content, appending')
				continue

			token = line.split('#')
			command = token[0]

			if command == 'jump': self.jump = token[1]
			elif command == 'start': self.update_state(token[1])
			elif command == 'tab':

				if not self.first: self.first = token[1]
				self.tabs[self.tabname] = self.content
				self.content = ''
				self.nexts[self.tabname] = token[1]
				self.prevs[token[1]] = self.tabname
				self.tabname = token[1]

			else: self.append_content(line)

		self.update_state('meta')

	def append_content (self, text):

		self.content += ('\n%s' % text)

	def check_dir_path (self, filepath):

		dirpath = os.path.dirname(filepath)
		if not os.path.exists(dirpath):
			os.makedirs(dirpath)

	def output_index_file (self, page_name, jumpfile_path):

		if self.debug: print('Dump Index', file=sys.stderr)
		if self.verbose: print('\tIndex file %s' % jumpfile_path, file=sys.stderr)

		self.check_dir_path(jumpfile_path)

		filecontent = ("jump#%s/%s/%s/" % (self.base, page_name, self.first.upper()))
		with open(jumpfile_path, 'w') as outfile:
			outfile.write(filecontent)

	def output_many_tabs (self, page_name, build_dir):

		if self.debug: print('Dump Tabs', file=sys.stderr)

		for name, value in self.tabs.items():

			if name == None: continue

			path = os.path.normpath(os.path.join(build_dir, self.base, page_name, name.upper(), 'index.page.six'))
			self.touch_files.append(path)

			if self.verbose:
				print('\tTab file %s' % path, file=sys.stdout)

			self.check_dir_path(path)

			varmeta = self.meta

			if name in self.prevs.keys() and self.prevs[name]:
				varmeta += '\ntabprev#/%s/%s/%s/' % (base, page_name, self.prevs[name].upper())

			if name in self.nexts.keys() and self.nexts[name]:
				varmeta += '\ntabnext#/%s/%s/%s/' % (base, page_name, self.nexts[name].upper())

			filecontent = ('%s\nstart#side\n%s\nstart#page\n%s' % (varmeta, self.side, value))
			with open(path, 'w') as outfile:
				outfile.write(filecontent)

	def output_side_file (self, filename):

		with open(filename, 'w') as f:
			print('%s' % self.side, file=f)

	def output_single_tab (self, index_path):

		if self.verbose: print('\tSingle tab file %s' % index_path, file=sys.stdout)
		if self.debug: print('Dump Single Tab', file=sys.stderr)

		self.check_dir_path(index_path)
		if self.jump:
			filecontent = 'jump#%s' % self.jump
		else:
			filecontent = ('%s\nstart#side\n%s\nstart#page\n%s' % (self.meta, self.side, self.tabs[None]))
		with open(index_path, 'w') as outfile:
			outfile.write(filecontent)

	def get_path (self, build_dir, page_name, six_type):

		filename = 'index.%s.six' % six_type
		if page_name == 'index':
			path = os.path.join(build_dir, self.base, filename)
		else:
			path = os.path.join(build_dir, self.base, page_name, filename)

		return os.path.normpath(path)

	def output_tab_files (self, page_name, build_dir):

		page_name = self.name(page_name)

		if self.jump:

			path = self.get_path(build_dir, page_name, 'jump')
			self.touch_files.append(path)
			self.output_single_tab(path)

		elif self.first:

			#path = os.path.normpath(os.path.join(build_dir, base, page_name, 'index.jump.six'))
			path = self.get_path(build_dir, page_name, 'jump')
			self.touch_files.append(path)
			self.output_index_file(page_name, path)

			#path = os.path.normpath(os.path.join(build_dir, base, page_name, 'index.side.six'))
			path = self.get_path(build_dir, page_name, 'side')
			self.touch_files.append(path)
			self.output_side_file(path)

			self.output_many_tabs(page_name, build_dir)

		else:

			#path = os.path.normpath(os.path.join(build_dir, base, page_name, 'index.page.six'))
			path = self.get_path(build_dir, page_name, 'page')
			self.touch_files.append(path)
			self.output_single_tab(path)

	def output_touch_file (self, touch_file, origin_files):

		if self.verbose:
			print('\tTouch file %s' % touch_file, file=sys.stdout)

		origin_list = ' '.join(origin_files)

		with open(touch_file, 'w') as f:

			print('SIX_FILES += %s' % (' '.join(self.touch_files)), file=f)
			for i in self.touch_files:
				print('%s: %s' % (i, origin_list), file=f)
