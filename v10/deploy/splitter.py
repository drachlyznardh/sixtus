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
		self.content = False

		self.first   = False
		self.tabname = None

		self.tabs  = {}
		self.prevs = {}
		self.nexts = {}

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
		self.content = False

		return self

	def split_file (self, filename):

		if self.debug:
			print('Now splitting file %s' % filename, file=sys.stderr)

		with open(sys.argv[1]) as f:
			for i in f:

				line = i.strip()
				if self.debug: print(line)

				if line[0] == '#':
					if self.debug: print('Line is a comment, skip')
					continue

				if '#' not in line:
					if self.content: self.content += ('\n%s' % line)
					else: self.content = line
					if self.debug: print('Line is simple content, appending')
					continue

				token = line.split('#')
				command = token[0]

				if command == 'start':

					self.update_state(token[1])

				elif command == 'tab':

					if not self.first: self.first = token[1]
					self.tabs[self.tabname] = self.content
					self.content = False
					self.nexts[self.tabname] = token[1]
					self.prevs[token[1]] = self.tabname
					self.tabname = token[1]

				elif self.content:
					self.content += ('\n%s' % line)
				else:
					self.content = line

		self.update_state('meta')
		return self

	def check_dir_path (self, filepath):

		dirpath = os.path.dirname(filepath)
		if not os.path.exists(dirpath):
			os.makedirs(dirpath)

	def dump_index (self):

		self.check_dir_path(self.index_path)

		filecontent = ("jump#%s/%s/" % (self.pag_path, self.first.upper()))
		with open(self.index_path, 'w') as outfile:
			outfile.write(filecontent)

	def dump_tabs (self):

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

		self.check_dir_path(self.index_path)
		filecontent = ('%s\nstart#side\n%s\nstart#page\n%s' % (self.meta, self.side, self.content))
		with open(self.index_path, 'w') as outfile:
			outfile.write(filecontent)

		with open(sys.argv[6], 'w') as f:
			print('SIX_FILES += %s' % self.index_path, file=f)
			print('%s: %s' % (self.index_path, sys.argv[1]), file=f)

	def dump_touch (self):

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

