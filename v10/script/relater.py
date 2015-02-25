#!/usr/bin/python
# -*- encoding: utf-8 -*-

import sys

class Relater:

	def __init__ (self, rel_file, name_file):

		with open(rel_file) as f:
			self.rel_list = eval(f.read())

		with open(name_file) as f:
			self.name_map = eval(f.read())

	def relate (self, year, month):

		self.this_page = [year, month, self.name_map[month]]

		short_name = '%s/%s' % (year, month)

		try: index = self.rel_list.index(short_name)
		except:
			print('This_Page (%s) is not in the list (%s)' % (short_name, self.rel_list))
			sys.exit(1)

		if index > 0:
			self.prev_page = self.rel_list[index - 1].split('/')
			self.prev_page.append(self.name_map[self.prev_page[1]])
		else: self.prev_page = False

		if index < len(self.rel_list) - 1:
			self.next_page = self.rel_list[index + 1].split('/')
			self.next_page.append(self.name_map[self.next_page[1]])
		else: self.next_page = False
