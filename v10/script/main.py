#!/usr/bin/python
# encoding: utf-8

from __future__ import print_function

from runtime import Runtime
from resources import Resources
from blog import Blog
from pages import Pages

import util
import os

'''
Actual destination is not destination, but the jump file
Filler should write it and invoke its php conversion
Or it could directly build the final index.php file
'''

class Filler:

	def __init__ (self):

		with open('conf.py', 'r') as f:
			conf = eval(f.read())

		self.location = conf.get('location')

		with open('map.py', 'r') as f:
			sitemap = eval(f.read())

		self.match = sorted(sitemap.values())

	'''
	There's no need to explore the whole deployment space for candidate
	directories, since they can only be matched with names in the map.

	I can generate the list from there, and then check whether they have an
	index or not.
	'''
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

		print(self.match)
		print([name for name in self.match])
		print([name for name in [name.split('/') for name in self.match] if len(name) > 1])

		#raise Exception('I\'m not done')

		result = []
		root = self.location.get('deploy')

		for source in self.find_all_dirs(root):
			for destination in self.match:
				if destination.startswith(source):
					result.append((source, destination))

		return sorted(result)

	def build_pair (self, pair):

		source, destination = pair

		#print('Building  %s → %s' % (pair))
		content = 'jump|%s/' % destination
		jump_file = os.path.join(self.location.get('six'), source, 'jump.six')

		print('Dumping [%s] on %s' % (content, jump_file))

		#util.assert_dir(jump_file)
		#with open(jump_file, 'w') as f:
		#	print(content, file=f)

	def update_pair (self, pair):

		source, destination = pair

		if not os.path.exists(destination):
			#print('destination %s does not exist!' % destination)
			self.build_pair(pair)
			return True

		source_time = os.path.getmtime(source)
		dest_time = os.path.getmtime(destination)

		if source_time - dest_time > 0.5:
			#print('source %s is more recent than destination %s' % (source, destination))
			self.build_pair(pair)
			return True

		#print('destination %s is up to date' % destination)
		return False

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

		#for source, destination in self.find_all_pairs():
		#	print('%s → %s' % (source, destination))

		for pair in self.find_all_pairs():
			self.update_pair(pair)

print('Siχtus 0.10')
Runtime().build()
Resources().build()
Blog().build()
Pages().build()
Filler().build()
print('Siχtus 0.10, done')
