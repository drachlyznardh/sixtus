#!/usr/bin/python
# encoding: utf-8

from __future__ import print_function
import sys
import os
import re

import util

class Runtime:

	def __init__ (self):

		self.debug = {key:True for key in ['explain']}
		self.time_delta = 0.5

		with open('conf.py', 'r') as f:
			self.conf = eval(f.read())

		if 'location' not in self.conf:
			raise Exception('Location does not appear in the configuration')
		self.location = self.conf['location']
		self.location['runtime'] = '/opt/devel/web/sixtus/v10/runtime'

	def copy (self, source, destination):

		util.assert_dir(destination)
		with open(destination, 'w') as df:
			with open(source, 'r') as sf:
				print(sf.read(), file=df)

	def copy_static_file (self, name):

		in_file = os.path.join(self.location['runtime'], name)
		out_file = os.path.join(self.location['deploy'], 'sixtus', name)

		if not os.path.exists(out_file):
			if self.debug.get('explain', False):
				print('out file %s does not exist' % out_file)
			self.copy(in_file, out_file)
			return True

		in_time = os.path.getmtime(in_file)
		out_time = os.path.getmtime(out_file)
		if in_time - out_time > self.time_delta:
			if self.debug.get('explain', False):
				print('in file %s is more recent than out file %s' % (in_file, out_file))
			self.copy(in_file, out_file)
			return True

		if self.debug.get('explain', False):
			print('out file %s is up to date' % out_file)
		return False

	def build (self):

		for name in ['icon.ico', 'panel.js', 'style.css']:
			self.copy_static_file(name)
