#!/usr/bin/python
# encoding: utf-8

from __future__ import print_function
import sys
import os
import re

import util
import build

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

		self.dirmap = {}
		self.bundles = []

		print(self.location)
		print(self.files)

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

	def build_Six_files (self):
		for name in self.files['Six']:
			if not os.path.exists(name):
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

	def load_bundles (self):
		for name in self.files['dep']:
			destination, source, bundles = build.parse_dep_file(name)
			self.dirmap[destination] = source
			self.bundles += bundles

	def load_six_files (self):
		self.files['six'] += [util.get_six_filename(bundle) for bundle in self.bundles]
		if self.debug: print('Files[six] = %s' % self.files['six'])

	def load_php_files (self):
		self.files['php'] += [util.get_php_filename(bundle) for bundle in self.bundles]
		if self.debug: print('Files[php] = %s' % self.files['php'])

	def load_wave_two (self):
		self.load_bundles()
		self.load_six_files()
		self.load_php_files()

	def build_six_files (self):
		for stem in self.files['six']:
			name = os.path.join(self.location['build'], stem)
			if not os.path.exists(name):
				six_dir = build.locate_six_dir(os.path.dirname(stem), self.dirmap)
				Six_file = os.path.join(self.location['build'], '%s.Six' %
				self.dirmap[six_dir])
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
sixtus.build()
sys.exit(0)

print('Siχtus 0.10')

src_dir = 'src'
build_dir = 'build'
deploy_dir = '/opt/web/mobile'

pag_files = util.find_all_files ('src', '*.pag')
Six_files = [re.sub(r'^src(.*)\.pag$', r'build\1.Six', i) for i in pag_files]
dep_files = [re.sub(r'(.*)\.Six$', r'\1.dep', i) for i in Six_files]

print('pag_files = %s' % pag_files)
print('Six_files = %s' % Six_files)
print('dep_files = %s' % dep_files)

for Six_file in Six_files:

	if not os.path.exists(Six_file):
		print('Six file [%s] does not exist!' % Six_file)
		build.build_Six_file(Six_file)

for dep_file in dep_files:

	if not os.path.exists(dep_file):
		print('dep file [%s] does not exist!' % dep_file)
		build.build_dep_file(dep_file)

six_dirs  = {}
php_names = []

for dep_file in dep_files:

	mapped, stem, tab_files = build.parse_dep_file(dep_file)

	six_dirs[mapped] = stem
	php_names += tab_files

six_files = [util.get_six_filename(bundle) for bundle in php_names]
php_files = [util.get_php_filename(bundle) for bundle in php_names]
print('six_files = %s' % six_files)
print('php_files = %s' % php_files)

for name in six_files:

	six_file = os.path.join(build_dir, name)
	if not os.path.exists(six_file):
		print('six file %60s does not exist!' % six_file)

		six_dir = build.locate_six_dir(os.path.dirname(name), six_dirs)

		print('Match found! "%s" → "%s"' % (six_dir, six_dirs[six_dir]))

		Six_file = os.path.join('build', '%s.Six' % six_dirs[six_dir])
		output_dir = os.path.join('build', six_dir)

		build.build_six_files(Six_file, output_dir)

for bundle in php_names:

	php_type = bundle[0]
	php_base = bundle[1]
	six_file = os.path.join(build_dir, util.get_six_filename(bundle))
	php_file = os.path.join(deploy_dir, util.get_php_filename(bundle))

	if not os.path.exists(php_file):
		print('PHP file %60s does not exist!' % php_file)

		if php_type == 0: # page
			build.build_page_file(php_base, six_file, php_file)
		elif php_type == 1: # jump
			build.build_jump_file(php_base, six_file, php_file)
		elif php_type == 2: # side
			build.build_side_file(php_base, six_file, php_file)

print('Siχtus 0.10, done')

sys.exit(0)
