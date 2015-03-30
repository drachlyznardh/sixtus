#!/usr/bin/python
# encoding: utf-8

from __future__ import print_function
import sys
import os
import re

import util

class Runtime:

	def __init__ (self):

		with open('conf.py', 'r') as f:
			self.conf = eval(f.read())

		if 'location' not in self.conf:
			raise Exception('Location does not appear in the configuration')
		self.location = self.conf['location']
		self.location['runtime'] = '/opt/devel/web/sixtus/v10/runtime'

	def copy_static_file (self, name):

		in_file = os.path.join(self.location['runtime'], name)
		out_file = os.path.join(self.location['deploy'], 'sixtus', name)
		print('%s → %s' % (in_file, out_file))

	def build (self):

		self.copy_static_file('icon.ico')
