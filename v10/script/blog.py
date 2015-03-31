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
		self.prevmap = {}
		self.nextmap = {}

	def populate (self):

		root = self.location['blog-in']
		month_pattern = re.compile(r'^(.*).post$')
		for year in os.listdir(root):
			self.blogmap[year] = []
			for month in os.listdir(os.path.join(root, year)):
				if month_pattern.match(month):
					self.blogmap[year].append(month_pattern.sub(r'\1', month))

		self.months = [(year, month) for year in sorted(self.blogmap.keys()) for month in sorted(self.blogmap[year])]

		old = self.months[0]
		for current in self.months[1:]:
			self.prevmap[current] = old
			self.nextmap[old] = current
			old = current

		years = sorted(self.blogmap.keys())
		old = years[0]
		for current in years[1:]:
			self.prevmap[current] = old
			self.nextmap[old] = current
			old = current

	def get_post_filename (self, stem):
		return os.path.join(self.location['blog-in'], stem[0], '%s.post' % stem[1])

	def get_pag_filename (self, stem):
		return os.path.join(self.location['blog-out'], stem[0], '%s.pag' % stem[1])

	def build_month (self, stem):

		post_file = self.get_post_filename(stem)
		pag_file = self.get_pag_filename(stem)

		raise Exception('Not yet implemented')

	def update_month (self, stem):

		year, month = stem

		post_file = self.get_post_filename(stem)
		pag_file = self.get_pag_filename(stem)

		if not os.path.exists(pag_file):
			if self.debug.get('explain', False):
				print('pag file %s does not exist' % pag_file)
			self.build_month(stem)
			return True

		post_time = os.path.getmtime(post_file)
		pag_time = os.path.getmtime(pag_file)
		if post_time - pag_time > self.time_delta:
			if self.debug.get('explain', False):
				print('post file %s is more recent than pag file %s' % (post_file, pag_file))
			self.build_month(stem)
			return True

		if self.debug.get('explain', False):
			print('')
		return False

		print('%s → %s' % (post_file, pag_file))

	def build (self):

		print('Blog stuff')
		self.populate()

		print('Prev = %s' % ', '.join('%s: %s' % (k, v) for k, v in
		sorted(self.prevmap.items())))
		print('Next = %s' % self.nextmap)

		#print([os.path.join(year, month) for year in sorted(blogmap.keys()) for month in sorted(blogmap[year])])
		#for stem in self.get_months():
		#	self.update_month(stem)

		print('Blog stuff done')

