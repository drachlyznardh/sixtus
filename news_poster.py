# -*- encoding: utf-8 -*-

from __future__ import print_function

from month_poster import Poster as Helper
from itertools import groupby

class Poster:

	def __init__ (self, home, title, subtitle):

		self.home = home
		self.title = title
		self.subtitle = subtitle
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
			count = sum([len(i) for i in h.post_content.values()])

			if count >= threshold:
				self.collect(stem, h, threshold)
				break

			self.collect(stem, h, count)
			threshold -= count

	def output_pag_file (self, pag_file):

		output = ''

		output += 'title|%s\n' % self.title
		output += 'subtitle|%s\n' % self.subtitle
		output += 'start|side\n'

		for year, month, content in [(year, month, content) for year, x in reversed(sorted(self.content.items())) for (month, content) in reversed(sorted((x.items())))]:
			output += '\tstitle@right|%s %s\n' % (year, month)
			#print(content)
			#print(dict(content))
			compact = {}
			for day, post in reversed(sorted(content)):
				if day in compact: compact.get(day).append(post)
				else: compact[day] = [post]

			for day, post_list in reversed(sorted(compact.items())):
				output += '\t<code>%02d/%02d</code> –\n' % (int(day), int(month))
				output += '\t\tlink|%s/%s/%02d/|%s|%02d-%d\n' % (self.home, year, int(month), post_list[0].title, int(day), 0)
				progress = 1
				for post in post_list[1:]:
					output += '\t\t&amp;\n'
					output += '\t\tlink|%s/%s/%02d/|%s|%02d-%d\n' % (self.home, year, int(month), post.title, int(day), progress)
					progress += 1

		output += 'start|page\n'
		many = False

		for year in sorted(self.content, reverse=True):
			for month in sorted(self.content.get(year), reverse=True):
				for day in sorted(self.content.get(year).get(month), reverse=True):
					progress = 0
					for post in self.content.get(year).get(month).get(day):

						if many: output += 'br|\n'
						else: many = True

						destination = '%s/%s/%s' % (self.home, year, month)
						date = '%s/%s/%s' % (day, month, year)
						ref = '%s-%d' % (day, progress)
						output += 'link|%s|%s|%s\n' % (destination, date, ref)
						output += post.display_category()
						output += 'title|%s\n' % post.title
						output += '%s\n' % post.content

						progress += 1

		with open(pag_file, 'w') as f:
			print(output, file=f)
