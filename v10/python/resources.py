#!/usr/bin/python
# encoding: utf-8

from __future__ import print_function
import sys
import os
import re

import util

class Resources:

	def __init__ (self):

		self.debug = {} #key:True for key in ['explain']}
		self.time_delta = 0.5

		with open('conf.py', 'r') as f:
			self.conf = eval(f.read())

		if 'location' not in self.conf:
			raise Exception('Location does not appear in the configuration')
		self.location = self.conf['location']

		with open('map.py', 'r') as f:
			self.sitemap = eval(f.read())

	def copy_static (self, source, destination):

		if self.debug.get('loud', False):
			print('Copying resource file %s to %s' % (source, destination))

		util.assert_dir(destination)
		with open(destination, 'w') as df:
			with open(source, 'r') as sf:
				print(sf.read(), file=df)

	def update_file (self, name, callback):

		in_file = os.path.join(self.location.get('res'), name)
		out_file = os.path.join(self.location.get('deploy'), self.map_Six_to_six(name))

		if not os.path.exists(out_file):
			if self.debug.get('explain', False):
				print('resource file %s does not exist' % out_file)
			callback(in_file, out_file)
			return True

		in_time = os.path.getmtime(in_file)
		out_time = os.path.getmtime(out_file)
		if in_time - out_time > self.time_delta:
			if self.debug.get('explain', False):
				print('origin file %s is more recent than resource file %s' % (in_file, out_file))
			callback(in_file, out_file)
			return True

		if self.debug.get('explain', False):
			print('resource file %s is up to date' % out_file)
		return False

	def map_Six_to_six (self, stem):

		discarded = []
		partial = stem

		while partial and partial not in self.sitemap:
			partial, last = os.path.split(partial)
			if last != 'index':
				discarded.append(util.convert(last))

		translated = self.sitemap.get(partial, '')
		if len(discarded):
			discarded.reverse()
			translated = os.path.join(translated,
				os.path.join(*discarded))

		return translated

	def build (self):

		for name in util.find_all_sources(self.location.get('res'), r'^(.*)$', False):
			self.update_file(name, self.copy_static)
