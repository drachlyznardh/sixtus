# encoding: utf-8

from __future__ import print_function
import sys
import os
import re

from base import Base
import util

# Builders
import month_poster
import year_poster
import archive_poster
import news_poster

class Blog(Base):

	def __init__ (self, bag):

		Base.__init__(self, bag)
		self.home = self.loc.get('blog-home')

		self.blogmap = {}
		self.prevmap = {}
		self.nextmap = {}

	def populate (self):

		root = self.loc['blog-in']
		month_pattern = re.compile(r'^(.*)\.post$')
		for year in os.listdir(root):
			self.blogmap[year] = []
			for month in os.listdir(os.path.join(root, year)):
				if month_pattern.match(month):
					self.blogmap[year].append(month_pattern.sub(r'\1', month))

		self.month = [(year, month) for year in sorted(self.blogmap.keys()) for month in sorted(self.blogmap[year])]

		old = self.month[0]
		for current in self.month[1:]:
			self.prevmap[current] = old
			self.nextmap[old] = current
			old = current

		years = sorted(self.blogmap.keys())
		old = years[0]
		for current in years[1:]:
			self.prevmap[current] = old
			self.nextmap[old] = current
			old = current

	def get_struct_filename (self):
		return os.path.join(self.loc.get('list'), 'blog-struct.py')

	def get_archive_filename (self):
		return os.path.join(self.loc.get('blog-out'), '%s.pag' % self.conf.get('lang').get('blog').get('archive_title'))

	def get_news_filename (self):
		return os.path.join(self.loc.get('blog-out'), 'index.pag')

	def get_post_filename (self, stem):
		return os.path.join(self.loc['blog-in'], stem[0], '%s.post' % stem[1])

	def get_feed_filename (self):
		return self.loc.get('feed')

	def get_pag_filename (self, stem):
		if isinstance(stem, tuple):
			return os.path.join(self.loc['blog-out'], stem[0], '%s.pag' % stem[1])
		if isinstance(stem, str):
			return os.path.join(self.loc['blog-out'], '%s.pag' % stem)

	def get_list_filename (self, stem):
		if isinstance(stem, tuple):
			return os.path.join(self.loc['list'], stem[0], '%s.list' % stem[1])
		if isinstance(stem, str):
			return os.path.join(self.loc['list'], '%s.list' % stem)
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

		subtitle = self.conf.get('lang').get('blog').get('month_subtitle')
		this_page = self.pair_to_triplet(stem)
		prev_page = self.pair_to_triplet(self.prevmap.get(stem, None))
		next_page = self.pair_to_triplet(self.nextmap.get(stem, None))

		p = month_poster.Poster(self.home, subtitle, this_page, prev_page, next_page)
		p.parse_file(post_file)
		util.assert_dir(pag_file)
		p.output_pag_file(pag_file)
		util.assert_dir(list_file)
		p.output_list_file(list_file)

	def update_month (self, stem):

		year, month = stem

		post_file = self.get_post_filename(stem)
		pag_file = self.get_pag_filename(stem)
		list_file = self.get_list_filename(stem)

		if self.force:
			self.explain_why('Force rebuild of pag file %s' % pag_file)
			self.build_month(stem)
			return True

		if not os.path.exists(pag_file):
			self.explain_why('pag file %s does not exist' % pag_file)
			self.build_month(stem)
			return True

		if not os.path.exists(list_file):
			self.explain_why('list file %s does not exist' % pag_file)
			self.build_month(stem)
			return True

		post_time = os.path.getmtime(post_file)
		pag_time = os.path.getmtime(pag_file)
		list_time = os.path.getmtime(list_file)

		if post_time - pag_time > self.time_delta:
			self.explain_why('post file %s is more recent than pag file %s' % (post_file, pag_file))
			self.build_month(stem)
			return True

		if post_time - list_time > self.time_delta:
			self.explain_why('post file %s is more recent than list file %s' % (post_file, list_file))
			self.build_month(stem)
			return True

		self.explain_why_not('month page file %s is up to date' % pag_file)
		return False

	def build_year (self, year):

		pag_file = self.get_pag_filename(year)
		list_file = self.get_list_filename(year)

		prev_year = self.prevmap.get(year, None)
		next_year = self.nextmap.get(year, None)

		names = self.conf.get('lang').get('month')
		subtitle = self.conf.get('lang').get('blog').get('year_subtitle')

		p = year_poster.Poster(self.home, year, prev_year, next_year, names, subtitle)
		p.parse_files([(month, self.get_list_filename((year, month))) for month in sorted(self.blogmap.get(year))])
		p.output_pag_file(pag_file)
		p.output_list_file(list_file)

	def update_year (self, year):

		pag_file = self.get_pag_filename(year)

		if self.force:
			self.explain_why('Force rebuild of pag file %s' % pag_file)
			for month in self.blogmap[year]:
				self.update_month((year, month))
			self.build_year(year)
			return True

		if not os.path.exists(pag_file):
			self.explain_why('pag file %s does not exist' % pag_file)
			for month in self.blogmap[year]:
				self.update_month((year, month))
			self.build_year(year)
			return True

		for month in sorted(self.blogmap[year]):
			self.update_month((year, month))
		pag_time = os.path.getmtime(pag_file)

		for month in sorted(self.blogmap[year]):
			list_file = self.get_list_filename((year, month))
			list_time = os.path.getmtime(list_file)
			if list_time - pag_time > self.time_delta:
				self.explain_why('list file %s is more recent than pag file %s' % (list_file, pag_file))
				self.build_year(year)
				return True

		self.explain_why_not('year page file %s is up to date' % pag_file)
		return False

	def load_struct (self):

		struct_file = self.get_struct_filename()
		if os.path.exists(struct_file):
			with open(struct_file, 'r') as f:
				old_struct = eval(f.read())
		else: old_struct = []

		return old_struct

	def build_archive (self):

		title = self.conf.get('lang').get('blog').get('archive_title')
		subtitle = self.conf.get('lang').get('blog').get('archive_subtitle')

		p = archive_poster.Poster(title, subtitle)
		p.parse_files([(year, self.get_list_filename(year)) for year in sorted(self.blogmap.keys())])
		p.output_pag_file(self.get_archive_filename())

	def build_news (self):

		title = self.conf.get('lang').get('blog').get('news_title')
		subtitle = self.conf.get('lang').get('blog').get('news_subtitle')
		threshold = self.conf.get('lang').get('blog').get('news_threshold')
		archive = self.conf.get('lang').get('blog').get('archive_title')
		names = self.conf.get('lang').get('month')

		p = news_poster.Poster(self.home, title, subtitle, archive, names)
		p.parse_target_list([(i, self.get_post_filename(i)) for i in reversed(self.month)], threshold)
		p.output_pag_file(self.get_news_filename())
		p.output_feed_file(self.get_feed_filename())

	def update_index (self):

		index_file = self.get_news_filename()

		if self.force:
			self.explain_why('Force rebuild of index file %s' % index_file)
			self.build_news()
			return True

		if not os.path.exists(index_file):
			self.explain_why('Index file %s does not exist' % index_file)
			self.build_news()
			return True

		index_time = os.path.getmtime(index_file)
		list_file = self.get_list_filename(self.month[-1])
		list_time = os.path.getmtime(list_file)
		if list_time - index_time > self.time_delta:
			self.explain_why('list file %s is more recent than index file %s' % (list_file, index_file))
			self.build_news()
			return True

		self.explain_why_not('index file %s is up to date' % index_file)
		return False

	def build_struct (self):

		with open(self.get_struct_filename(), 'w') as f:
			print(self.month, file=f)

	def update_struct (self):

		struct = self.load_struct()

		if self.force:
			self.explain_why('Force blog rebuild')
			self.build_archive()
			self.build_news()
			self.build_struct()
			return True

		if len(struct) != len(self.month) or len([a for a in struct if a not in self.month]) or len([a for a in self.month if a not in struct]):
			self.explain_why('blog structure changed')
			self.build_archive()
			self.build_news()
			self.build_struct()
			return True

		self.update_index()
		return False

	def build (self):

		self.populate()

		for year in sorted(self.blogmap.keys()):
			self.update_year(year)

		self.update_struct()
		self.stats('%03d blog pages' % len(self.month))
