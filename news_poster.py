# -*- encoding: utf-8 -*-

from __future__ import print_function

from month_poster import Poster as Helper

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
		self.content.get(year)[month] = ([(i, x) for i, j in reversed(sorted(helper.post.items())) for x in j][:count])

	def parse_target_list (self, target_list):
		threshold = 10
		for stem, target in target_list:
			#print('Targeting file [%s]' % target)
			h = Helper(False, False, False, False, False)
			h.parse_file(target)
			count = sum([len(i) for i in h.post_content.values()])
			#print('[%s] has %d posts' % (target, count))
			if count >= threshold:
				#print('Using %d posts from %s' % (threshold, target))
				self.collect(stem, h, threshold)
				break

			#print('Using %d posts from %s' % (count, target))
			self.collect(stem, h, count)
			threshold -= count

	def parse_target (self, list_file):

		with open(list_file, 'r') as f:
			for line in f.readlines():
				self.parse_line(line.strip())

	def output_pag_file (self, pag_file):
		pass
		#content = 'jump|%s#%s' % (self.post_url, self.post_hash)

		#with open(pag_file, 'w') as f:
		#	print(content, file=f)
