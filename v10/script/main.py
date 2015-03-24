#!/usr/bin/python
# encoding: utf-8

from __future__ import print_function
import sys
import os
import re

import util
import build
import mapper
import roman

class Sixtus:

	def __init__ (self):

		self.debug = True

		self.location = {}

		self.location['pag'] = 'src'
		self.location['blog'] = 'blog'
		self.location['build'] = 'build'
		self.location['deploy'] = '/opt/web/mobile'

		self.files = {key:[] for key in 'pag Six dep six php'.split()}

		self.match = {}
		self.match['pag'] = re.compile(r'^%s(.*)\.pag$' % self.location['pag'])

		self.replace = {}
		self.replace['Six'] = r'%s\1.Six' % self.location['build']
		self.replace['dep'] = r'%s\1.dep' % self.location['build']

		self.deps = {}
		self.dirmap = {}
		self.bundles = []

	def load_pag_files (self):
		self.files['pag'] += util.find_all_files(self.location['pag'], '*.pag')
		if self.debug: print('Files[pag] = %s' % self.files['pag'])

	def load_Six_files (self):
		self.files['Six'] += [self.match['pag'].sub(self.replace['Six'], name) for name in self.files['pag']]
		if self.debug: print('Files[Six] = %s' % self.files['Six'])

	def load_dep_files (self):
		self.files['dep'] += [self.match['pag'].sub(self.replace['dep'], name) for name in self.files['pag']]
		if self.debug: print('Files[dep] = %s' % self.files['dep'])

	def load_wave_one (self):
		self.load_pag_files()
		self.load_Six_files()
		self.load_dep_files()

	def check_Six_file (self, name):
		if not os.path.exists(name):
			print('Six file %s does not exist' % name)
			return True
		if name not in self.deps:
			print('Six file %s does not appear in deps' % name)
			return False
		print('%s was modified on %s' % (name, os.path.getmtime(name)))
		for dep in self.deps[name]:
			print('%s was modified on %s' % (dep, os.path.getmtime(dep)))

	def build_Six_files (self):
		for name in self.files['Six']:
			if self.check_Six_file(name):
				build.build_Six_file(name)
			elif self.debug:
				print('Six file %30s already exists' % name)

	def build_dep_files (self):
		for name in self.files['dep']:
			if not os.path.exists(name):
				build.build_dep_file(name)
			elif self.debug:
				print('dep file %30s already exists' % name)

	def build_wave_one (self):
		self.build_Six_files()
		self.build_dep_files()

	def parse_Six_six_mapping (self, Six_dir):
		mapped = mapper.get('map.py', os.path.dirname(Six_dir))
		basename = os.path.basename(Six_dir)
		if basename == 'index': return mapped
		return os.path.join(mapped, roman.convert(basename))

	def parse_dep_file (self, dep_file):

		stem = re.sub(r'build/(.*)\.dep', r'\1', dep_file)
		mapped = self.parse_Six_six_mapping (stem)
		self.dirmap[mapped] = stem

		with open(dep_file, 'r') as f:
			jump, sources, tab_names = eval(f.read())

		Six_file = os.path.join(self.location['build'], '%s.Six' % stem)
		self.deps[Six_file] = sources

		size = len(tab_names)
		if jump:
			self.bundles.append((1, mapped))
		elif size == 0:
			self.bundles.append((0, mapped))
		elif size == 1:
			self.bundles.append((1, mapped))
			self.bundles.append((0, os.path.join(mapped, roman.convert(tab_names[0]))))
		else:
			self.bundles.append((1, mapped))
			self.bundles.append((2, mapped))
			for name in tab_names:
				self.bundles.append((0, os.path.join(mapped, roman.convert(name))))

	def parse_dep_files (self):
		for name in self.files['dep']:
			self.parse_dep_file(name)

	def load_six_files (self):
		self.files['six'] += [util.get_six_filename(bundle) for bundle in self.bundles]
		if self.debug: print('Files[six] = %s' % self.files['six'])

	def load_php_files (self):
		self.files['php'] += [util.get_php_filename(bundle) for bundle in self.bundles]
		if self.debug: print('Files[php] = %s' % self.files['php'])

	def load_wave_two (self):
		self.parse_dep_files()
		self.load_six_files()
		self.load_php_files()

	def get_split_directories (self, name):

		six_dir = os.path.dirname(name)
		while six_dir and six_dir not in self.dirmap:
			print('%s does not match' % six_dir)
			six_dir = os.path.dirname(six_dir)

		if six_dir not in self.dirmap:
			print('Could not map %s!' % name)
			sys.exit(1)

		return self.dirmap[six_dir], six_dir

	def build_six_files (self):
		for stem in self.files['six']:
			name = os.path.join(self.location['build'], stem)
			if not os.path.exists(name):
				Six_dir, six_dir = self.get_split_directories(stem)
				Six_file = os.path.join(self.location['build'], '%s.Six' % Six_dir)
				destination = os.path.join(self.location['build'], six_dir)
				build.build_six_files(Six_file, destination)
			elif self.debug:
				print('six file %s already exists!' % name)

	def build_php_files (self):
		for bundle in self.bundles:
			six_file = os.path.join(self.location['build'],
				util.get_six_filename(bundle))
			php_file = os.path.join(self.location['deploy'],
				util.get_php_filename(bundle))

			if not os.path.exists(php_file):
				if bundle[0] == 0:
					build.build_page_file(bundle[1], six_file, php_file)
				elif bundle[0] == 1:
					build.build_jump_file(bundle[1], six_file, php_file)
				elif bundle[0] == 2:
					build.build_side_file(bundle[1], six_file, php_file)
			elif self.debug:
				print('php file %s already exists!' % php_file)

	def build_wave_two (self):
		self.build_six_files()
		self.build_php_files()

	def build (self):
		self.load_wave_one()
		self.build_wave_one()
		self.load_wave_two()
		self.build_wave_two()
		return

sixtus = Sixtus()
print('Siχtus 0.10')
sixtus.build()
print('Siχtus 0.10, done')
