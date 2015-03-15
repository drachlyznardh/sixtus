#!/usr/bin/python
# -*- encoding: utf-8 -*-

from __future__ import print_function
import sys
import os
import roman

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
			self.save_tab()
		else: self.error('What is state %s supposed to be?' % (self.state, newstate))

		self.state = newstate
		self.content = ''

	def save_tab (self):

		if self.tabname in self.tabs:
			self.tabs[self.tabname] += self.content
		else: self.tabs[self.tabname] = self.content

	def split_content (self, lines):

		for line in lines:

			self.lineno += 1
			if self.debug: print(line)

			if len(line) and line[0] == '#':
				if self.debug: print('Line is a comment, skip')
				continue

			if '|' not in line:
				self.append_content(line)
				if self.debug: print('Line is simple content, appending')
				continue

			token = line.split('|')
			command = token[0]

			if command == 'jump': self.jump = token[1]
			elif command == 'start': self.update_state(token[1])
			elif command == 'tab':

				if not self.first: self.first = token[1]
				self.save_tab()
				self.nexts[self.tabname] = token[1]
				self.prevs[token[1]] = self.tabname
				self.tabname = token[1]
				self.content = ''

			else: self.append_content(line)

		self.update_state('meta')

	def append_content (self, text):

		self.content += ('%s\n' % text)

	def check_dir_path (self, filepath):

		dirpath = os.path.dirname(filepath)
		if not os.path.exists(dirpath):
			os.makedirs(dirpath)

	def output_index_file (self, page_name, jumpfile_path):

		if self.debug: print('Dump Index', file=sys.stderr)
		if self.verbose: print('\tIndex file %s' % jumpfile_path, file=sys.stderr)

		self.check_dir_path(jumpfile_path)

		if page_name == 'Index':
			destination = ("%s/%s/" % (self.base, roman.convert(self.first)))
		else:
			destination = ("%s/%s/%s/" % (self.base, page_name, roman.convert(self.first)))
		filecontent = ("jump|%s" % destination)
		with open(jumpfile_path, 'w') as outfile:
			outfile.write(filecontent)

	def output_many_tabs (self, page_name, side_path, build_dir):

		if self.debug: print('Dump Tabs', file=sys.stderr)

		for name, value in self.tabs.items():

			if name == None: continue

			if page_name == 'Index': tab_name = roman.convert(name)
			else: tab_name = '%s/%s' % (page_name, roman.convert(name))
			path = self.get_path(build_dir, tab_name, 'page')
			self.touch_files.append(path)

			if self.verbose:
				print('\tTab file %s' % path, file=sys.stdout)

			self.check_dir_path(path)

			varmeta = self.meta

			if name in self.prevs.keys() and self.prevs[name]:
				if page_name == 'Index':
					destination = '%s/%s' % (self.base, roman.convert(self.prevs[name]))
				else:
					destination = '%s/%s/%s' % (self.base, page_name, roman.convert(self.prevs[name]))
				varmeta += 'tabprev|/%s/\n' % destination

			if name in self.nexts.keys() and self.nexts[name]:
				if page_name == 'Index':
					destination = '%s/%s' % (self.base, roman.convert(self.nexts[name]))
				else:
					destination = '%s/%s/%s' % (self.base, page_name, roman.convert(self.nexts[name]))
				varmeta += 'tabnext|/%s/\n' % destination

			varmeta += 'side|%s\n' % side_path

			filecontent = ('%sstart|page\n%s' % (varmeta, value))
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
			filecontent = 'jump|%s' % self.jump
		else:
			filecontent = ('%s\nstart|side\n%s\nstart|page\n%s' % (self.meta, self.side, self.tabs[None]))
		with open(index_path, 'w') as outfile:
			outfile.write(filecontent)

	def get_path (self, build_dir, page_name, six_type):

		filename = 'index.%s.six' % six_type
		if page_name == 'Index':
			path = os.path.join(build_dir, self.base, filename)
		else:
			path = os.path.join(build_dir, self.base, page_name, filename)

		return os.path.normpath(path)

	def output_tab_files (self, page_name, build_dir):

		if self.jump:

			path = self.get_path(build_dir, page_name, 'jump')
			self.touch_files.append(path)
			self.output_single_tab(path)

		elif self.first:

			path = self.get_path(build_dir, page_name, 'jump')
			self.touch_files.append(path)
			self.output_index_file(page_name, path)

			path = self.get_path(build_dir, page_name, 'side')
			self.touch_files.append(path)
			self.output_side_file(path)

			self.output_many_tabs(page_name, '../side.php', build_dir)

		else:

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
