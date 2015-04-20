# -*- encoding: utf-8 -*-

from __future__ import print_function

from util import assert_dir

class Poster:

	def __init__ (self, home):

		self.home = home

		self.side = []
		self.page = []

	def parse_conf (self, conf):

		archive_conf = conf['lang']['blog']['archive']
		self.title = archive_conf['title']
		self.subtitle = archive_conf['subtitle']

		news_conf = conf['lang']['blog']['news']
		self.news = news_conf['title']

		news_conf = conf.get('lang').get('blog').get('news')
		self.news = news_conf.get('title')

	def parse_files (self, list_files):

		for stem in list_files:
			self.side.append(stem[0])
			with open(stem[1], 'r') as f:
				self.page.append(f.read().strip())

	def output_pag_file (self, pag_file):

		output = 'title|%s\n' % self.title
		output += 'subtitle|%s\n' % self.subtitle
		output += 'prev|%s|%s\n' % (self.home, self.news)

		output += 'start|page\n'
		output += '%s\n' % '\nbr|\n'.join(self.page)

		output += 'start|side\n'
		output += 'stitle|%s\n' % self.title
		output += 'c|%s' % '\n/\n'.join(['link||%s|%s' % (i,i) for i in self.side])

		assert_dir(pag_file)
		with open(pag_file, 'w') as f:
			print(output, file=f)
