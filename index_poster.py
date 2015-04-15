# -*- encoding: utf-8 -*-

from __future__ import print_function

from month_poster import Poster as Helper

class Poster:

	def __init__ (self, home):#, title, subtitle):

		self.home = home
		#self.title = title
		#self.subtitle = subtitle

	def parse_line (self, line):

		if not line.startswith('link|'): return

		token = line.split('|')
		self.post_url = token[1]
		self.post_hash = token[3]

	def parse_target_list (self, target_list):
		for target in target_list:
			print('Targeting file [%s]' % target)
			h = Helper(False, False, False, False, False)
			h.parse_file(target)
			count = sum([len(i) for i in h.post_content.values()])
			print('[%s] has %d posts' % (target, count))

	def parse_target (self, list_file):

		with open(list_file, 'r') as f:
			for line in f.readlines():
				self.parse_line(line.strip())

	def output_pag_file (self, pag_file):
		pass
		#content = 'jump|%s#%s' % (self.post_url, self.post_hash)

		#with open(pag_file, 'w') as f:
		#	print(content, file=f)
