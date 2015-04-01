#!/usr/bin/python
# -*- encoding: utf-8 -*-

from __future__ import print_function
import sys
import os
import util

class Splitter:

	def __init__ (self):

		self.debug = False

		self.state = 0

		self.jump = False
		self.content = ''
		self.tabs = {}
		self.meta = ''
		self.side = ''
		self.tabname = None
		self.tabnames = []

	def get_tab_order (self):

		seen = set()
		f = seen.add
		return [x for x in self.tabnames if x and not (x in seen or f(x))]

	def get_tab_relation (self, order):

		tabnext = {}
		tabprev = {}
		current = order[0]

		for i in order[1:]:

			tabnext[current] = i
			tabprev[i] = current
			current = i

		return tabnext, tabprev

	def append (self, text):

		self.content += '%s\n' % text

	def update_tab (self):

		if self.tabname in self.tabs:
			self.tabs[self.tabname] += self.content
		else: self.tabs[self.tabname] = self.content

		self.content = ''
		self.tabnames.append(self.tabname)
		self.tabname = None

	def update_state (self, newstate):

		if self.state == 0:
			self.meta += self.content
			self.content = ''
		elif self.state == 2:
			self.side += self.content
			self.content = ''
		else: self.update_tab()

		if newstate == 'meta': self.state = 0
		elif newstate == 'page': self.state = 1
		elif newstate == 'side': self.state = 2
		else: raise 'What state is %s supposed to be?' % newstate

	def parse_file (self, filename):

		with open(filename, 'r') as f:
			for i in f.readlines():
				self.parse_line(i.strip())

		self.update_state('meta')

	def parse_line (self, line):

		if '|' not in line:
			self.append(line)
			return

		token = line.split('|')
		c = token[0]

		if c == 'tab':
			self.update_tab()
			self.tabname = token[1]
		elif c == 'start': self.update_state(token[1])
		elif c == 'jump': self.jump = token[1]
		else: self.append(line)

	def output_single_jump_file (self, base, destination):

		jump_path = os.path.join(destination, 'jump.six')
		if self.debug: print('Jump file on [%s]' % jump_path)
		util.assert_dir(jump_path)
		with open(jump_path, 'w') as f:
			print('jump|%s' % self.jump, file=f)

	def output_all_files (self, base, destination):

		files = []
		order = self.get_tab_order()
		tabnext, tabprev = self.get_tab_relation(order)

		jump_path = os.path.join(destination, 'jump.six')
		if self.debug: print('Jump file on [%s]' % jump_path, file=sys.stderr)
		util.assert_dir(jump_path)
		with open(jump_path, 'w') as f:
			print('jump|%s/' % os.path.join(base, util.convert(order[0])), file=f)

		side_path = os.path.join(destination, 'side.six')
		if self.debug: print('Side file on [%s]' % side_path, file=sys.stderr)
		#util.assert_dir(side_path)
		with open(side_path, 'w') as f:
			print(self.side, file=f)

		files.append(jump_path)
		files.append(side_path)

		for name in order:

			varmeta = self.meta
			if name in tabprev:
				prevtab = util.convert(tabprev[name])
				varmeta += 'tabprev|%s/%s/\n' % (destination, prevtab)
			if name in tabnext:
				nexttab = util.convert(tabnext[name])
				varmeta += 'tabnext|%s/%s/\n' % (destination, nexttab)
			varmeta += 'side|../side.php\n'

			tab_path = os.path.join(destination, util.convert(name), 'page.six')
			if self.debug: print(' Tab file on [%s]' % tab_path)
			util.assert_dir(tab_path)
			with open(tab_path, 'w') as f:
				print('%sstart|page\n%s' % (varmeta, self.tabs[name]), file=f)

			files.append(tab_path)

	def output_default_tab (self, base, destination):

		page_path = os.path.join(destination, 'page.six')
		if self.debug: print('Page file on [%s]' % page_path)
		util.assert_dir(page_path)
		with open(page_path, 'w') as f:
			print('%sstart|side\n%sstart|page\n%s' % (self.meta, self.side, self.tabs[None]), file=f)

	def output_single_tab (self, base, destination):

		name = [name for name in self.tabs if name][0]

		page_path = os.path.join(destination, util.convert(name), 'page.six')
		if self.debug: print('Page file on [%s]' % page_path)
		util.assert_dir(page_path)
		with open(page_path, 'w') as f:
			print('%sstart|side\n%sstart|page\n%s' % (self.meta, self.side,
			self.tabs[name]), file=f)

		jump_path = os.path.join(destination, 'jump.six')
		if self.debug: print('Jump file on [%s]' % jump_path)
		with open(jump_path, 'w') as f:
			print('jump|%s/' % os.path.join(base, util.convert(name)), file=f)

	def output_files (self, base, destination):

		if self.jump:
			self.output_single_jump_file(base, destination)
			return

		size = len(self.tabs)

		if size == 1: self.output_default_tab(base, destination)
		elif size == 2: self.output_single_tab(base, destination)
		else: self.output_all_files(base, destination)
