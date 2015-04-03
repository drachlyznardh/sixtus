#!/usr/bin/python
# encoding: utf-8

from __future__ import print_function

import util
import os
import php

class Filler:

	def __init__ (self):

		self.debug = {} # key:True for key in ['explain']}

		with open('conf.py', 'r') as f:
			conf = eval(f.read())

		self.location = conf.get('location')

		with open('map.py', 'r') as f:
			sitemap = eval(f.read())

		self.match = sorted(sitemap.values())

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

		source, destination = pair

		content = 'jump|%s/' % destination
		jump_file = os.path.join(self.location.get('deploy'), source, 'index.php')

		php.from_jump_target_to_php_file(destination, jump_file)

	def update_pair (self, pair):

		source, destination = pair

		if not os.path.exists(destination):
			if self.debug.get('explain', False):
				print('destination %s does not exist!' % destination)
			self.build_pair(pair)
			return True

		source_time = os.path.getmtime(source)
		dest_time = os.path.getmtime(destination)

		if source_time - dest_time > 0.5:
			if self.debug.get('explain', False):
				print('source %s is more recent than destination %s' % (source, destination))
			self.build_pair(pair)
			return True

		if self.debug.get('explain', False):
			print('destination %s is up to date' % destination)
		return False

	def build (self):

		for pair in self.find_all_pairs():
			self.update_pair(pair)
