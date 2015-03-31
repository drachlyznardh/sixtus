#!/usr/bin/python
# encoding: utf-8

from __future__ import print_function
import sys
import os
import re

import util

class Blog:

	def __init__ (self):

		self.debug = {key:True for key in ['explain']}
		self.time_delta = 0.5

		with open('conf.py', 'r') as f:
			self.conf = eval(f.read())

		if 'location' not in self.conf:
			raise Exception('Location does not appear in the configuration')
		self.location = self.conf['location']
		self.location['runtime'] = '/opt/devel/web/sixtus/v10/runtime'

	def build (self):

		print('Blog stuff')
		blogmap = {}
		root = self.location['blog']
		month_pattern = re.compile(r'^(.*).post$')
		for year in os.listdir(root):
			blogmap[year] = []
			for month in os.listdir(os.path.join(root, year)):
				if month_pattern.match(month):
					blogmap[year].append(month_pattern.sub(r'\1', month))

		for year, months in sorted(blogmap.items()):
			print('%s: %s' % (year, ', '.join(sorted(months))))

		print('Blog stuff done')

