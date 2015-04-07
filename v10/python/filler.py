#!/usr/bin/python
# encoding: utf-8

from __future__ import print_function
import os

from sixtus import Sixtus
import util

import php

class Filler(Sixtus):

	def __init__ (self, bag):

		Sixtus.__init__(self, bag)

	def get_jump_filename (self, pair):
		return os.path.join(self.location.get('deploy'), pair[0], 'index.php')

	def find_all_pairs (self):

		result = []
		found = set()
		root = self.location.get('deploy')

		values = sorted(self.sitemap.values())

		for cat in values:

			pieces = cat.split('/')
			if len(pieces) == 1: pass

			source = ''
			for piece in pieces[:-1]:
				source = os.path.join(source, piece)
				if source not in values and source not in found:
					found.add(source)
					result.append((source, cat))

		return result

	def build_pair (self, pair):

		root = self.location.get('deploy')
		jump_file = os.path.join(root, pair[0], 'index.php')

		self.loud('Generating jump file %s' % jump_file)
		util.assert_dir(jump_file)
		php.from_jump_target_to_php_file(pair[1], jump_file)

	def remove_pair (self, pair):

		root = self.location.get('deploy')
		jump_file = os.path.join(root, pair[0], 'index.php')

		if os.path.exists(jump_file):
			self.loud('Removing jump file %s' % jump_file)
			os.unlink(jump_file)

	def update_pair (self, pair):

		source, destination = pair
		jump_file = self.get_jump_filename(pair)

		if not os.path.exists(jump_file):
			self.explain_why('jump_file %s does not exist!' % jump_file)
			self.build_pair(pair)
			return True

		#source_time = os.path.getmtime(source)
		#dest_time = os.path.getmtime(jump_file)

		#if source_time - dest_time > self.time_delta:
		#	self.explain_why('source %s is more recent than destination %s' % (source, destination))
		#	self.build_pair(pair)
		#	return True

		self.explain_why_not('destination %s is up to date' % destination)
		return False

	def remove_pair (self, pair):

		jump_file = os.path.join(self.location.get('deploy'), pair[0], 'index.php')

		if os.path.exists(jump_file):
			self.loud('Removing jump file %s' % jump_file)
			os.unlink(jump_file)

	def build (self):

		for pair in self.find_all_pairs():
			self.update_pair(pair)

	def remove (self):

		for pair in self.find_all_pairs():
			self.remove_pair(pair)

