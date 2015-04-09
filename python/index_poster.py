#!/usr/bin/python
# -*- encoding: utf-8 -*-

from __future__ import print_function

class Poster:

	def __init__ (self, home):

		self.home = home

	def parse_target (self, targetlist):

		self.target = '%s/%s' % (targetlist[-1])

	def output_pag_file (self, pag_file):

		content = 'jump|%s/%s/' % (self.home, self.target)

		with open(pag_file, 'w') as f:
			print(content, file=f)
