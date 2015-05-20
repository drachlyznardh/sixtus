# encoding: utf-8

from __future__ import print_function

import os

class Tex:

	def __init__ (self):
		pass

	def parse (self, targets):
		if len(targets):
			for target in targets:
				print('Target %s' % target)
		else:
			root = os.getcwd()
			print('Empty target, using current dir %s' % root)
