#!/usr/bin/python
# -*- encoding: utf-8 -*-

from __future__ import print_function
import sys
import os

class Splitter:

	def __init__ (self):

		self.debug = False

		self.state = 'meta'

		self.meta    = ''
		self.side    = ''
		self.content = ''

		self.first   = False
		self.tabname = None

		self.tabs  = {}
		self.prevs = {}
		self.nexts = {}

		self.filename = ''
		self.lineno = 0
		self.inclusion = []

	def load_parameters (self, args):

		with open(args[0]) as f:
			sitemap = eval(f.read())

		if args[1] not in sitemap:
			print('Cannot map [%s] from [%s]!' % (args[1], args[0]), file=sys.stderr)
			sys.exit(1)

		self.pag_path = '%s/%s' % (sitemap[args[1]], args[2].upper())
		self.index_path = '%s%s/index.six' % (args[3], self.pag_path)

		return self

	def update_state (self, newstate):

		if self.state == 'meta':
			self.meta += self.content
		elif self.state == 'side':
			self.side += self.content
		elif self.state == 'page':
			self.tabs[self.tabname] = self.content

		self.state = newstate
		self.content = ''

		return self

	def split_file (self, filename):

		if self.filename:
			self.inclusion.append((self.filename, self.lineno + 1))
		self.filename = filename
		self.lineno = 0
		self.append_content('filename#%s#0' % filename)

		if self.debug:
			print('Now splitting file %s' % filename, file=sys.stderr)

		with open(filename) as f:
			for i in f:

				line = i.strip()
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

				if command == 'start':

					self.update_state(token[1])

				elif command == 'require':

					print('Requiring file %s' % token[1], file=sys.stderr)
					file_path = '%s/%s' % ('/'.join(sys.argv[1].split('/')[:-1]), token[1])
					print('Including file %s' % file_path, file=sys.stderr)
					self.split_file(file_path)

				elif command == 'tab':

					if not self.first: self.first = token[1]
					self.tabs[self.tabname] = self.content
					self.content = ''
					self.nexts[self.tabname] = token[1]
					self.prevs[token[1]] = self.tabname
					self.tabname = token[1]

				else: self.append_content(line)

		self.update_state('meta')

		if len(self.inclusion):
			self.filename, self.lineno = self.inclusion.pop()
			self.append_content('filename#%s#%d' % (self.filename, self.lineno))

		return self

	def append_content (self, text):

		if self.content:
			self.content += ('\n%s' % text)
		else: self.content = text

	def check_dir_path (self, filepath):

		dirpath = os.path.dirname(filepath)
		if not os.path.exists(dirpath):
			os.makedirs(dirpath)

	def dump_index (self):

		if self.debug: print('Dump Index', file=sys.stderr)

		self.check_dir_path(self.index_path)

		filecontent = ("jump#%s/%s/" % (self.pag_path, self.first.upper()))
		with open(self.index_path, 'w') as outfile:
			outfile.write(filecontent)

	def dump_tabs (self):

		if self.debug: print('Dump Tabs', file=sys.stderr)

		self.touchlist = []

		for name, value in self.tabs.items():

			if name == None: continue

			file_path = '%s%s/%s/index.six' % (sys.argv[5], self.pag_path, name.upper())
			self.touchlist.append(file_path)

			self.check_dir_path(file_path)

			varmeta = self.meta

			if name in self.prevs.keys() and self.prevs[name]:
				varmeta += '\ntabprev#/%s/%s/' % (self.pag_path, self.prevs[name].upper())

			if name in self.nexts.keys() and self.nexts[name]:
				varmeta += '\ntabnext#/%s/%s/' % (self.pag_path, self.nexts[name].upper())

			filecontent = ('%s\nstart#side\n%s\nstart#page\n%s' % (varmeta, self.side, value))
			with open(file_path, 'w') as outfile:
				outfile.write(filecontent)

	def dump_single_tab (self):

		if self.debug: print('Dump Single Tab', file=sys.stderr)

		self.check_dir_path(self.index_path)
		filecontent = ('%s\nstart#side\n%s\nstart#page\n%s' % (self.meta, self.side, self.tabs[None]))
		with open(self.index_path, 'w') as outfile:
			outfile.write(filecontent)

		with open(sys.argv[6], 'w') as f:
			print('SIX_FILES += %s' % self.index_path, file=f)
			print('%s: %s' % (self.index_path, sys.argv[1]), file=f)

	def dump_touch (self):

		if self.debug: print('Dump Touch', file=sys.stderr)

		self.touchlist.append(self.index_path)

		with open(sys.argv[6], 'w') as f:
			print('SIX_FILES += %s' % (' '.join(self.touchlist)), file=f)
			for i in self.touchlist:
				print('%s: %s' % (i, sys.argv[1]), file=f)

	def dump_output (self):

		if self.first:
			self.dump_index()
			self.dump_tabs()
			self.dump_touch()
		else: self.dump_single_tab()

