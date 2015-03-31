#!/usr/bin/python
# -*- encoding: utf-8 -*-

from __future__ import print_function

class Poster:

	def __init__ (self, home):

		self.home = home

pag_file = sys.argv[1]

with open(sys.argv[2], 'r') as f:
	target = eval(f.read())

with open(pag_file, 'w') as f: print('jump|Blog/%s/' % sorted(target)[-1], file=f)
