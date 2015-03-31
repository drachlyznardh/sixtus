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

		self.blogmap = {}

	def get_post_filename (self, stem):
		return os.path.join(self.location['blog-in'], stem[0], '%s.post' % stem[1])


	def get_months (self):

		return [(year, month) for year in sorted(self.blogmap.keys()) for month in sorted(self.blogmap[year])]

	def update_month (self, stem):

		year, month = stem

		post_file = self.get_post_filename(stem)
		print('post file %s' % post_file)

	def build (self):

		print('Blog stuff')
		root = self.location['blog-in']
		month_pattern = re.compile(r'^(.*).post$')
		for year in os.listdir(root):
			self.blogmap[year] = []
			for month in os.listdir(os.path.join(root, year)):
				if month_pattern.match(month):
					self.blogmap[year].append(month_pattern.sub(r'\1', month))

		#print([os.path.join(year, month) for year in sorted(blogmap.keys()) for month in sorted(blogmap[year])])
		for stem in self.get_months():
			self.update_month(stem)

		print('Blog stuff done')

