# -*- encoding: utf-8 -*-

from __future__ import print_function
import os

from util import assert_dir
from month_poster import Poster as Helper
from itertools import groupby

class Poster:

	def __init__ (self, home, title, subtitle, archive, names):

		self.home = home
		self.title = title
		self.subtitle = subtitle
		self.archive = archive
		self.names = names
		self.content = {}

	def parse_line (self, line):

		if not line.startswith('link|'): return

		token = line.split('|')
		self.post_url = token[1]
		self.post_hash = token[3]

	def collect (self, stem, helper, count):
		year, month = stem
		if year not in self.content: self.content[year] = {}
		selected = [(i, x) for i, j in reversed(sorted(helper.post.items())) for x in j][:count]
		addenda = {k:[i for i in reversed([i for j,i in list(v)])] for k,v in groupby(selected, lambda x:x[0])}
		self.content.get(year)[month] = addenda

	def parse_target_list (self, target_list, threshold):

		for stem, target in target_list:

			h = Helper(False, False, False, False, False)
			h.parse_file(target)
			count = sum([len(i) for i in h.post.values()])

			if count >= threshold:
				self.collect(stem, h, threshold)
				break

			self.collect(stem, h, count)
			threshold -= count

	def output_pag_file (self, pag_file):

		output = ''

		output += 'title|%s\n' % self.title
		output += 'subtitle|%s\n' % self.subtitle
		output += 'next|%s/%s/|%s\n' % (self.home, self.archive, self.archive)

		output += 'start|side\n'
		many = False

		for year in sorted(self.content, reverse=True):
			for month in sorted(self.content.get(year), reverse=True):
				if many : output += '\tbr|\n'
				else: many = True
				output += '\tstitle@right|%s %s\n' % (self.names.get(month), year)
				for day in sorted(self.content.get(year).get(month), reverse=True):
					howmany = len(self.content.get(year).get(month).get(day)) -1
					progress = 0
					for post in self.content.get(year).get(month).get(day):

						if progress:
							output += '\t\t&amp;\n'
						else:
							date = '%s/%s' % (day, month)
							output += '\tp|<code>%s</code> –\n' % date

						destination = '%s/%s/%s/' % (self.home, year, month)
						ref = '%s-%d' % (day, howmany - progress)

						output += '\t\tlink|%s|%s|%s\n' % (destination, post.title, ref)
						progress += 1

		output += 'start|page\n'
		many = False

		for year in sorted(self.content, reverse=True):
			for month in sorted(self.content.get(year), reverse=True):
				for day in sorted(self.content.get(year).get(month), reverse=True):
					howmany = len(self.content.get(year).get(month).get(day)) -1
					progress = 0
					for post in self.content.get(year).get(month).get(day):

						if many: output += 'br|\n'
						else: many = True

						destination = '%s/%s/%s/' % (self.home, year, month)
						date = '%s/%s/%s' % (year, month, day)
						ref = '%s-%d' % (day, howmany - progress)
						output += 'link|%s|%s|%s\n' % (destination, date, ref)
						output += post.display_category()
						output += 'title|%s\n' % post.title
						output += '%s\n' % post.content

						progress += 1

		with open(pag_file, 'w') as f:
			print(output, file=f)

	def output_feed_file (self, filename):

		output = '<?php header("Content-Type: application/xml; charset=utf-8"); ?>'
		output += '<?xml version="1.0" encoding="utf-8"?>\n'
		output += '<rss version="2.0">\n'
		output += '\t<channel>\n'

		__version__ = open(os.path.join(os.path.dirname(__file__),'VERSION')).read().strip()
		output += '\t\t<generator>Siχtus v%s</generator>\n' % __version__
		output += '\t\t<title><?=$_SERVER["HTTP_HOST"]?></title>\n'

		for year in sorted(self.content, reverse=True):
			for month in sorted(self.content.get(year), reverse=True):
				destination = '%s/%s/%s/' % (self.home, year, month)
				for day in sorted(self.content.get(year).get(month), reverse=True):
					howmany = len(self.content.get(year).get(month).get(day)) -1
					progress = 0
					date = '%s/%s/%s' % (year, month, day)
					for post in self.content.get(year).get(month).get(day):

						ref = '%s-%d' % (day, howmany - progress)

						content = ''
						for line in post.content.split('\n'):
							if len(content) > 99: break
							if line.startswith('#'): continue
							if '|' in line: continue
							content += ' %s' % line.replace('<', '&lt;').replace('>', '&gt;')

						output += '\t\t<item>\n'
						output += '\t\t\t<title>%s – %s</title>\n' % (date, post.title)
						output += '\t\t\t<description>%s</description>\n' % content
						output += '\t\t\t<guid>http://<?=$_SERVER["HTTP_HOST"]?>/%s#%s</guid>\n' % (destination, ref)
						output += '\t\t</item>\n'

						progress += 1

		output += '\t</channel>\n'
		output += '</rss>'

		assert_dir(filename)
		with open(filename, 'w') as f:
			print(output)
			print(output, file=f)
