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

		self.debug = {'step':True, 'explain':True}

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

	def get_six_filename (self, bundle):
		extension = ['page.six', 'jump.six', 'side.six']
		return os.path.join(self.location['build'], bundle[1], extension[bundle[0]])

	def get_php_filename (self, bundle):
		extension = ['index.php', 'index.php', 'side.php']
		return os.path.join(self.location['deploy'], bundle[1], extension[bundle[0]])

	def load_pag_files (self):
		self.files['pag'] += util.find_all_files(self.location['pag'], '*.pag')
		if self.debug.get('list', False): print('Files[pag] = %s' % self.files['pag'])

	def load_Six_files (self):
		self.files['Six'] += [self.match['pag'].sub(self.replace['Six'], name) for name in self.files['pag']]
		if self.debug.get('list', False): print('Files[Six] = %s' % self.files['Six'])

	def load_dep_files (self):
		self.files['dep'] += [self.match['pag'].sub(self.replace['dep'], name) for name in self.files['pag']]
		if self.debug.get('list', False): print('Files[dep] = %s' % self.files['dep'])

	def load_wave_one (self):
		self.load_pag_files()
		self.load_Six_files()
		self.load_dep_files()

	def check_Six_file (self, name):
		if not os.path.exists(name):
			if self.debug.get('explain',False):
				print('Six file %s does not exist' % name)
			return True
		if name not in self.deps:
			if self.debug.get('search',False):
				print('Six file %s does not appear in deps' % name)
			return False
		this_time = os.path.getmtime(name)
		for dep in self.deps[name]:
			other_time = os.path.getmtime(dep)
			if this_time <= other_time:
				if self.debug.get('explain',False):
					print('Six file %s is more recent than source file %s' % (name, dep))
				return True
		return False

	def build_Six_files (self):
		for name in self.files['Six']:
			if self.check_Six_file(name):
				build.build_Six_file(name)
			elif self.debug.get('already',False):
				print('Six file %30s already exists' % name)

	def check_dep_file (self, name):
		if not os.path.exists(name):
			if self.debug.get('search',False):
				print('dep file %s does not exist' % name)
			return True
		this_time = os.path.getmtime(name)
		Six_file = name.replace('.dep', '.Six')
		other_time = os.path.getmtime(Six_file)
		if this_time <= other_time:
			if self.debug.get('search',False):
				print('dep file %s is more recent than Six file %s' % (name, Six_file))
			return True
		if self.debug.get('search',False):
			print('dep file %s is up to date' % name)
		return False

	def build_dep_files (self):
		for name in self.files['dep']:
			if self.check_dep_file(name):
				build.build_dep_file(name)
			elif self.debug.get('already',False):
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
		self.files['six'] += [self.get_six_filename(bundle) for bundle in self.bundles]
		if self.debug.get('list', False): print('Files[six] = %s' % self.files['six'])

	def load_php_files (self):
		self.files['php'] += [self.get_php_filename(bundle) for bundle in self.bundles]
		if self.debug.get('list', False): print('Files[php] = %s' % self.files['php'])

	def load_wave_two (self):
		self.parse_dep_files()
		self.build_wave_one()
		self.load_six_files()
		self.load_php_files()

	def get_split_directories (self, bundle):

		name = bundle[1]
		six_dir = os.path.dirname(name)
		while six_dir and six_dir not in self.dirmap:
			if self.debug.get('search',False):
				print('%s does not match' % six_dir)
			six_dir = os.path.dirname(six_dir)

		if six_dir not in self.dirmap:
			if self.debug.get('search',False):
				print('Could not map %s!' % name)
			sys.exit(1)

		return self.dirmap[six_dir], six_dir

	def get_Six_filename (self, bundle):
		try: Six_dir = self.dirmap[bundle[1]]
		except: Six_dir = self.dirmap[os.path.dirname(bundle[1])]
		direct = os.path.join(self.location['build'], '%s.Six' % Six_dir)
		if os.path.exists(direct): return direct
		indirect = os.path.join(self.location['build'], Six_dir, 'index.Six')
		if os.path.exists(indirect): return indirect
		print('Cannot locate a Six file for %s, [%s]' % bundle)
		print('Nor %s nor %s exist' % (direct, indirect))
		sys.exit(1)

	def check_six_file (self, bundle):
		six_file = self.get_six_filename(bundle)
		if not os.path.exists(six_file):
			if self.debug.get('search',False):
				print('six file %s does not exist' % six_file)
			return True
		six_time = os.path.getmtime(six_file)
		Six_file = self.get_Six_filename(bundle)
		Six_time = os.path.getmtime(Six_file)
		if six_time <= Six_time:
			if self.debug.get('search',True):
				print('six file %s is more recent than Six file %s' % (six_file, Six_file))
			return True
		return False

	def build_six_files (self):
		for bundle in self.bundles:
			if self.check_six_file(bundle):
				Six_dir, six_dir = self.get_split_directories(bundle)
				Six_file = os.path.join(self.location['build'], '%s.Six' % Six_dir)
				destination = os.path.join(self.location['build'], six_dir)
				build.build_six_files(Six_file, destination)
			elif self.debug.get('already',False):
				print('six file %s already exists!' % name)

	def check_php_file (self, six_file, php_file):
		if not os.path.exists(php_file):
			if self.debug.getg('explain',False):
				print('php file %s does not exist' % php_file)
			return True
		six_time = os.path.getmtime(six_file)
		php_time = os.path.getmtime(php_file)
		if six_time <= php_time:
			if self.debug.get('explain',False):
				print('six file %s is more recent than php file %s' % (six_file, php_file))
			return True
		return False

	def build_php_files (self):
		for bundle in self.bundles:

			six_file = self.get_six_filename(bundle)
			php_file = self.get_php_filename(bundle)

			if self.check_php_file(six_file, php_file):
				if bundle[0] == 0:
					build.build_page_file(bundle[1], six_file, php_file)
				elif bundle[0] == 1:
					build.build_jump_file(bundle[1], six_file, php_file)
				elif bundle[0] == 2:
					build.build_side_file(bundle[1], six_file, php_file)
			elif self.debug.get('already',False):
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
