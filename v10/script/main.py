#!/usr/bin/python
# encoding: utf-8

from __future__ import print_function

from runtime import Runtime
from resources import Resources
from blog import Blog
from pages import Pages

import os

class Filler:

	def __init__ (self):

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
			#for name in visit:
			dirname = os.path.join(root, name)
			if os.path.isdir(dirname) and name[0] != '.' and name != 'sixtus':
				content = os.listdir(dirname)
				if 'index.php' not in content:
					result.append(name)
				for i in content: visit.append(os.path.join(name,i))
				#print('Found name %s' % name)
				#print('%s contains %s' % (dirname, os.listdir(dirname)))

		return result

	def find_all_pairs (self):

		result = []
		root = self.location.get('deploy')

		for source in self.find_all_dirs(root):
			for destination in self.match:
				if destination.startswith(source):
					result.append((source, destination))

		return result

	def build (self):

		#for match in sorted(self.match):
		#	print('Match (%s)' % match)

		#for name in self.get_all_dirs(self.location.get('deploy')):
		#	#print(name)
		#	for match in self.match:
		#		#if name in match:
		#		if match.startswith(name):
		#			print ('%s → %s' % (name, match))
		#			break

		for source, destination in self.find_all_pairs():
			print('%s → %s' % (source, destination))

print('Siχtus 0.10')
Runtime().build()
Resources().build()
Blog().build()
Pages().build()
Filler().build()
print('Siχtus 0.10, done')
