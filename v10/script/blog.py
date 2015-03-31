#!/usr/bin/python
# encoding: utf-8

from __future__ import print_function
import sys
import os
import re

import util

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

	def build (self):

		print('Blog stuff')
		print(util.find_all_sources(self.location['blog'], r'(.*).post'))
		print('Blog stuff done')

