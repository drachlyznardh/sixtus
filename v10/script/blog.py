#!/usr/bin/python
# encoding: utf-8

from __future__ import print_function
import sys
import os
import re

import util

# Builders
import poster

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
		if isinstance(stem, tuple):
			return os.path.join(self.location['blog-out'], stem[0], '%s.pag' % stem[1])
		if isinstance(stem, str):
			return os.path.join(self.location['blog-out'], '%s.pag' % stem)

	def get_list_filename (self, stem):
		if isinstance(stem, tuple):
			return os.path.join(self.location['six'], stem[0], '%s.list' % stem[1])
		if isinstance(stem, str):
			return os.path.join(self.location['six'], '%s.list' % stem)
		raise Exception('What stem is %s supposed to be?' % (stem))

	def pair_to_triplet (self, stem):
		if stem:
			name = self.conf.get('lang').get('month').get(stem[1])
			return (stem[0], stem[1], name)
		return None

	def build_month (self, stem):

		post_file = self.get_post_filename(stem)
		pag_file = self.get_pag_filename(stem)
		list_file = self.get_list_filename(stem)

		this_page = self.pair_to_triplet(stem)
		prev_page = self.pair_to_triplet(self.prevmap.get(stem, None))
		next_page = self.pair_to_triplet(self.nextmap.get(stem, None))

		p = poster.Poster(this_page, prev_page, next_page)
		p.parse_file(post_file)
		util.assert_dir(pag_file)
		p.output_pag_file(pag_file)
		util.assert_dir(list_file)
		p.output_list_file(list_file)

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
			print('pag file %s is up to date' % pag_file)
		return False

		print('%s → %s' % (post_file, pag_file))

	def update_year (self, year):

		pag_file = self.get_pag_filename(year)

		print('Update year %s' % pag_file)

	def build (self):

		print('Blog stuff')
		self.populate()

		for stem in self.months:
			self.update_month(stem)

		for year in sorted(self.blogmap.keys()):
			self.update_year(year)

		print('Blog stuff done')

