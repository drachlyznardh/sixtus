#!/usr/bin/python
# -*- encoding: utf-8 -*-

from __future__ import print_function
import sys

class Mapper:

	def __init__ (self, map_file, page_origin):

		with open(map_file) as f:
			site_map = eval(f.read())

		if page_origin not in site_map:
			print('Cannot map [%s] from [%s]!' % (page_origin, map_file), file=sys.stderr)
			sys.exit(1)

		self.base = site_map[page_origin]
