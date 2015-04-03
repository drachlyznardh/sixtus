#!/usr/bin/python
# encoding: utf-8

from __future__ import print_function
import os

from sixtus import Sixtus
import util

import php

class Filler(Sixtus):

	def __init__ (self):

		Sixtus.__init__(self)
		self.load_location('conf.py')
		self.load_sitematch('map.py')

	def find_all_dirs (self, root):

		result = []

		if not os.path.exists(root):
			raise Exception('root dir %s does not exist' % root)

		if not os.path.isdir(root):
			raise Exception('root dir %s is not a directory' % root)

		visit = os.listdir(root)

		while len(visit):
			name = visit.pop(0)
			dirname = os.path.join(root, name)
			if os.path.isdir(dirname) and name[0] != '.' and name != 'sixtus':
				content = os.listdir(dirname)
				if 'index.php' not in content:
					result.append(name)
				for i in content: visit.append(os.path.join(name,i))

		return result

	def find_all_pairs (self):

		result = []
		found = set()
		root = self.location.get('deploy')

		for cat in self.match:
			pieces = cat.split(os.sep)
			if len(pieces) < 2: pass
			candidate = ''
			for piece in pieces:
				candidate = os.path.join(candidate, piece)
				candir = os.path.join(root, candidate)
				if os.path.isdir(candir) and 'index.php' not in os.listdir(candir):
					if candidate not in found:
						found.add(candidate)
						result.append((candidate, cat))
		return result

		result = []
		root = self.location.get('deploy')

		for source in self.find_all_dirs(root):
			for destination in self.match:
				if destination.startswith(source):
					result.append((source, destination))

		return sorted(result)

	def build_pair (self, pair):

		root = self.location.get('deploy')
		jump_file = os.path.join(root, pair[0], 'index.php')

		self.loud('Generating jump file %s' % php_file)
		php.from_jump_target_to_php_file(pair[1], jump_file)

	def update_pair (self, pair):

		source, destination = pair

		if not os.path.exists(destination):
			self.explain('destination %s does not exist!' % destination)
			self.build_pair(pair)
			return True

		source_time = os.path.getmtime(source)
		dest_time = os.path.getmtime(destination)

		if source_time - dest_time > 0.5:
			self.explain('source %s is more recent than destination %s' % (source, destination))
			self.build_pair(pair)
			return True

		self.explain('destination %s is up to date' % destination)
		return False

	def build (self):

		for pair in self.find_all_pairs():
			self.update_pair(pair)

