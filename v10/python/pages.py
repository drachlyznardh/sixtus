#!/usr/bin/python
# encoding: utf-8

import sys
import os
import re

from sixtus import Sixtus
import util

# Builders
import Six
import dep
import six
import php

class Pages(Sixtus):

	def __init__ (self, bag):

		Sixtus.__init__(self, bag)

		self.sixSixmap = {}
		self.sources = {}
		self.products = []

	# Returns full path for a .pag file
	def get_pag_filename (self, name):
		return os.path.join(self.location['pag'], '%s.pag' % name)

	# Returns full path for a .Six file
	def get_Six_filename (self, name):
		return os.path.join(self.location['Six'], '%s.Six' % name)

	# Returns full path for a .src file
	def get_src_filename (self, name):
		return os.path.join(self.location['src'], '%s.src' % name)

	# Returns full path for a .dep file
	def get_dep_filename (self, name):
		return os.path.join(self.location['dep'], '%s.dep' % name)

	# Returns full path for a .six file
	def get_six_filename (self, bundle):
		extension = ['page.six', 'jump.six', 'side.six']
		return os.path.join(self.location['six'], bundle[1], extension[bundle[0]])

	# Returns full path for a .php file
	def get_php_filename (self, bundle):
		extension = ['index.php', 'index.php', 'side.php']
		return os.path.join(self.location['deploy'], bundle[1], extension[bundle[0]])

	# Locate source pages
	def find_page_sources (self):
		return util.find_all_sources(self.location['pag'], r'^(.*)\.pag$', True)

	# Loads existings .src files, compiles the sources dictionary
	def load_src_file (self, stem):

		src_file = self.get_src_filename(stem)
		if os.path.exists(src_file):
			self.sources[stem] = Six.from_src_file(src_file)

	# Builds .Six files, also loading their .src updates into the sources dictionary
	def build_Six_file (self, stem):

		pag_file = self.get_pag_filename(stem)
		Six_file = self.get_Six_filename(stem)
		src_file = self.get_src_filename(stem)

		self.loud('Expanding source file %s' % pag_file)

		self.sources[stem] = Six.from_pag_to_Six_file(pag_file, Six_file, src_file)

	# Updates a .Six file when needed. Returns true if updated
	def update_Six_file (self, stem):

		Six_file = self.get_Six_filename(stem)

		if not os.path.exists(Six_file):
			self.explain_why('Six file %s does not exist' % Six_file)
			self.build_Six_file(stem)
			return True

		Six_time = os.path.getmtime(Six_file)
		pag_file = self.get_pag_filename(stem)
		pag_time = os.path.getmtime(pag_file)

		if pag_time - Six_time > self.time_delta:
			self.explain_why('pag file %s is more recent than Six file %s' % (pag_file, Six_file))
			self.build_Six_file(stem)
			return True

		if not stem in self.sources: return False

		for each_file in self.sources[stem]:
			each_time = os.path.getmtime(each_file)
			if each_time - Six_time > self.time_delta:
				self.explain_why('pag file %s is more recent than source file %s' % (pag_file, each_file))
				self.build_Six_file(stem)
				return True

		self.explain_why_not('Six file %s is up to date' % Six_file)
		return False

	# Builds a .dep file, also loading product list
	def build_dep_file (self, stem):

		Six_file = self.get_Six_filename(stem)
		dep_file = self.get_dep_filename(stem)

		mapped = self.map_Six_to_six (stem)
		self.sixSixmap[mapped] = stem

		self.loud('Extracting dependencies from Six file %s' % Six_file)

		self.products += [(p[0], os.path.join(mapped, p[1])) for p in dep.from_Six_to_dep_file(Six_file, dep_file)]

	# Build a .dep file when needed. Returns true if updated
	def update_dep_file (self, stem):

		dep_file = self.get_dep_filename(stem)

		if not os.path.exists(dep_file):
			self.explain_why('dep file %s does not exist' % dep_file)
			self.update_Six_file(stem)
			self.build_dep_file(stem)
			return True

		if self.update_Six_file(stem):
			self.explain_why('Six file %s was just remade' % self.get_Six_filename(stem))
			self.build_dep_file(stem)
			return True

		dep_time = os.path.getmtime(dep_file)
		Six_file = self.get_Six_filename(stem)
		Six_time = os.path.getmtime(Six_file)
		if Six_time - dep_time > self.time_delta:
			self.explain_why('Six file %s is more recent than dep file %s' % (Six_file, dep_file))
			self.build_dep_file(stem)
			return True

		self.sixSixmap[self.map_Six_to_six(stem)] = stem
		self.explain_why_not('dep file %s is up to date' % dep_file)
		return False

	# Loads the content of a .dep file, creating it if needed
	def load_dep_file (self, stem):

		dep_file = self.get_dep_filename(stem)
		if not self.update_dep_file(stem):
			mapped = self.map_Six_to_six (stem)
			self.products += [(p[0], os.path.join(mapped, p[1])) for p in dep.from_dep_file(dep_file)]

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

	def map_six_to_Six (self, stem):

		if stem[1] in self.sixSixmap:
			return self.sixSixmap[stem[1]]

		directory = os.path.dirname(stem[1])
		if directory in self.sixSixmap:
			return self.sixSixmap[directory]

		raise Exception('Could not locate a Six file for (%s,%s)' % stem)

	def build_six_file (self, stem):

		Six_file = self.get_Six_filename(self.map_six_to_Six(stem))
		base = stem[1]
		destination = os.path.join(self.location['six'], stem[1])

		self.loud('Splitting Six file %s' % Six_file)

		six.from_Six_to_six_files(Six_file, base, destination)

	def update_six_file (self, stem):

		six_file = self.get_six_filename(stem)
		Six_stem = self.map_six_to_Six(stem)
		if not os.path.exists(six_file):
			self.explain_why('six file %s does not exist' % six_file)
			self.update_Six_file(Six_stem)
			self.build_six_file(stem)
			return True

		self.update_Six_file(Six_stem)
		six_time = os.path.getmtime(six_file)
		Six_file = self.get_Six_filename(Six_stem)
		Six_time = os.path.getmtime(Six_file)
		if Six_time - six_time > self.time_delta:
			self.explain_why('Six file %s is more recent than six file %s' % (Six_file, six_file))
			self.build_six_file(stem)
			return True

		self.explain_why_not('six file %s is up to date' % six_file)
		return False

	def build_php_file (self, stem):

		six_file = self.get_six_filename(stem)
		php_file = self.get_php_filename(stem)

		if stem[0] == 0:
			self.loud('Generating page file %s' % php_file)
			php.from_page_six_to_php_file(os.path.dirname(stem[1]), six_file, php_file)
		elif stem[0] == 1:
			self.loud('Generating jump file %s' % php_file)
			php.from_jump_six_to_php_file(os.path.dirname(stem[1]), six_file, php_file)
		elif stem[0] == 2:
			self.loud('Generating side file %s' % php_file)
			php.from_side_six_to_php_file(os.path.dirname(stem[1]), six_file, php_file)

	def update_php_file (self, stem):

		php_file = self.get_php_filename(stem)

		if not os.path.exists(php_file):
			self.explain_why('php file %s does not exist' % php_file)
			self.update_six_file(stem)
			self.build_php_file(stem)
			return True

		self.update_six_file(stem)
		php_time = os.path.getmtime(php_file)
		six_file = self.get_six_filename(stem)
		six_time = os.path.getmtime(six_file)
		if six_time - php_time > self.time_delta:
			self.explain_why('six file %s is more recent than php file %s' % (six_file,
				php_file))
			self.build_php_file(stem)
			return True

		self.explain_why_not('php file %s is up to date' % php_file)
		return False

	def remove_php_file (self, name):

		php_file = self.get_php_filename(name)

		if os.path.exists(php_file):
			self.loud('Removing php file %s' % php_file)
			os.unlink(php_file)

	def find_all_cat_jumps (self):

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

	def remove_php_dirs (self):

		targets = self.products + [(1,i) for i, j in self.find_all_cat_jumps()]

		for target in reversed(sorted(targets)):

			php_file = self.get_php_filename(target)

			if os.path.exists(php_file):
				self.loud('Removing file %s' % php_file)
				os.unlink(php_file)

			dirname = os.path.dirname(php_file)
			if os.path.exists(dirname):
				while len(os.listdir(dirname)) == 0:
					self.loud('Removing empty dir %s' % dirname)
					#print('Removing empty dir %s, then %s' % (dirname, os.path.dirname(dirname)))
					os.rmdir(dirname)
					dirname = os.path.dirname(dirname)

			#print('%s → %s' % (target, self.get_php_filename(target)))

			#dirname = os.path.join(self.location.get('deploy'), stem[1])
			#print('(%s) → %s' % (stem, dirname))
			#if os.path.exists(dirname): os.rmdir(dirname)
			#print('Dir %s removed' % dirname)

	def load_products (self):

		for stem in self.find_page_sources():
			self.load_src_file(stem)
			self.load_dep_file(stem)

	def build (self):

		self.load_products()

		for stem in self.products:
			self.update_php_file(stem)

	def remove (self):

		self.load_products()

		for stem in self.products:
			self.remove_php_file(stem)

		self.remove_php_dirs()
