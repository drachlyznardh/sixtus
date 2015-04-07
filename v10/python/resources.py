#!/usr/bin/python
# encoding: utf-8

from __future__ import print_function
import sys
import os
import re

from sixtus import Sixtus
import util

class Resources(Sixtus):

	def __init__ (self, bag):

		Sixtus.__init__(self, bag)

	def copy_file (self, source, destination):

		self.loud('Copying resource file %s to %s' % (source, destination))

		util.assert_dir(destination)
		with open(destination, 'w') as df:
			with open(source, 'r') as sf:
				print(sf.read(), file=df)

	def remove_file (self, name):

		out_file = os.path.join(self.location.get('deploy'), self.map_Six_to_six(name))

		if os.path.exists(out_file):
			self.loud('Removing resources file %s' % out_file)
			os.unlink(out_file)

	def update_file (self, name):

		in_file = os.path.join(self.location.get('res'), name)
		out_file = os.path.join(self.location.get('deploy'), self.map_Six_to_six(name))

		if not os.path.exists(out_file):
			self.explain_why('resource file %s does not exist' % out_file)
			self.copy_file(in_file, out_file)
			return True

		in_time = os.path.getmtime(in_file)
		out_time = os.path.getmtime(out_file)
		if in_time - out_time > self.time_delta:
			self.explain_why('origin file %s is more recent than resource file %s' % (in_file, out_file))
			self.copy_file(in_file, out_file)
			return True

		self.explain_why_not('resource file %s is up to date' % out_file)
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
			self.update_file(name)

	def remove (self):

		for name in util.find_all_sources(self.location.get('res'), r'^(.*)$', False):
			self.remove_file(name)

