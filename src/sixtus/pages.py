# encoding: utf-8

import sys, os, re

from .base import Base
from .util import find_all_sources, assert_dir, clean_empty_dirs

# Builders
from .Six import from_src_file, from_pag_to_Six_file
from .dep import from_dep_file, from_Six_to_dep_file
from .six import from_Six_to_six_files
from .php import from_jump_six_to_php_file, from_jump_target_to_php_file
from .php import from_page_six_to_php_file, from_side_six_to_php_file

class Pages(Base):

	def __init__ (self, bag):

		Base.__init__(self, bag)

		self.sixSixmap = {}
		self.sources = {}
		self.products = []
		self.forced = set()
		self.debug = bag.debug

	# Returns full path for a .pag file
	def get_pag_filename (self, name):
		return os.path.join(self.loc['pag'], '%s.pag' % name)

	# Returns full path for a .Six file
	def get_Six_filename (self, name):
		return os.path.join(self.loc['Six'], '%s.Six' % name)

	# Returns full path for a .src file
	def get_src_filename (self, name):
		return os.path.join(self.loc['src'], '%s.src' % name)

	# Returns full path for a .dep file
	def get_dep_filename (self, name):
		return os.path.join(self.loc['dep'], '%s.dep' % name)

	# Returns full path for a .six file
	def get_six_filename (self, bundle):
		extension = ['page.six', 'jump.six', 'side.six']
		return os.path.join(self.loc['six'], bundle[1], extension[bundle[0]])

	# Returns full path for a .php file
	def get_php_filename (self, bundle):
		extension = ['index.php', 'index.php', 'side.php']
		return os.path.join(self.loc['deploy'], bundle[1], extension[bundle[0]])

	# Returns full path for a category jump index.php file
	def get_cat_jump_filename (self, bundle):
		return os.path.join(self.loc['deploy'], bundle[0], 'index.php')

	# Locate source pages
	def find_page_sources (self):
		return find_all_sources(self.loc['pag'], r'^(.*)\.pag$', True)

	# Loads existings .src files, compiles the sources dictionary
	def load_src_file (self, stem):

		src_file = self.get_src_filename(stem)
		if os.path.exists(src_file):
			self.sources[stem] = from_src_file(src_file)

	# Builds .Six files, also loading their .src updates into the sources dictionary
	def build_Six_file (self, stem):

		pag_file = self.get_pag_filename(stem)
		Six_file = self.get_Six_filename(stem)
		src_file = self.get_src_filename(stem)

		self.loud('Expanding source file %s' % pag_file)

		self.sources[stem] = from_pag_to_Six_file(pag_file, Six_file, src_file, self.debug)

	# Updates a .Six file when needed. Returns true if updated
	def update_Six_file (self, stem):

		Six_file = self.get_Six_filename(stem)

		if self.force:
			self.explain_why('Force rebuild of Six file %s' % Six_file)
			self.build_Six_file(stem)
			return True

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

		self.products += [(p[0], os.path.join(mapped, p[1])) for p in from_Six_to_dep_file(Six_file, dep_file)]

	# Build a .dep file when needed. Returns true if updated
	def update_dep_file (self, stem):

		dep_file = self.get_dep_filename(stem)

		if self.force:
			self.explain_why('Force rebuild of dep file %s' % dep_file)
			self.update_Six_file(stem)
			self.build_dep_file(stem)
			return True

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
			self.products += [(p[0], os.path.join(mapped, p[1])) for p in from_dep_file(dep_file)]

	def map_six_to_Six (self, stem):

		if stem[1] in self.sixSixmap:
			return self.sixSixmap[stem[1]]

		directory = os.path.dirname(stem[1])
		if directory in self.sixSixmap:
			return self.sixSixmap[directory]

		raise Exception('Could not locate a Six file for (%s,%s)' % stem)

	def build_six_file (self, stem):

		Six_file = self.get_Six_filename(self.map_six_to_Six(stem))

		if Six_file in self.forced: return

		self.forced.add(Six_file)
		base = stem[1]
		destination = os.path.join(self.loc['six'], stem[1])

		self.loud('Splitting Six file %s' % Six_file)

		from_Six_to_six_files(Six_file, base, destination, True, self.debug)

	def update_six_file (self, stem):

		Six_stem = self.map_six_to_Six(stem)
		six_file = self.get_six_filename(stem)

		if self.force:
			self.explain_why('Force rebuild of six file %s' % six_file)
			self.update_Six_file(Six_stem)
			self.build_six_file(stem)
			return True

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
			from_page_six_to_php_file(os.path.dirname(stem[1]), six_file, php_file, self.debug)
		elif stem[0] == 1:
			self.loud('Generating jump file %s' % php_file)
			from_jump_six_to_php_file(os.path.dirname(stem[1]), six_file, php_file, self.debug)
		elif stem[0] == 2:
			self.loud('Generating side file %s' % php_file)
			from_side_six_to_php_file(os.path.dirname(stem[1]), six_file, php_file, self.debug)

	def update_php_file (self, stem):

		php_file = self.get_php_filename(stem)

		if self.force:
			self.explain_why('Force rebuild of php file %s' % php_file)
			self.update_six_file(stem)
			self.build_php_file(stem)
			return True

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
		root = self.loc['deploy']

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

	def build_cat_jump_file (self, pair):

		root = self.loc['deploy']
		jump_file = os.path.join(root, pair[0], 'index.php')

		self.loud('Generating jump file %s' % jump_file)
		assert_dir(jump_file)
		from_jump_target_to_php_file(pair[1], jump_file, self.debug)

	def update_cat_jump_file (self, pair):

		source, destination = pair
		jump_file = self.get_cat_jump_filename(pair)

		if self.force:
			self.explain_why('Force rebuild of cat jump file %s' % jump_file)
			self.build_cat_jump_file(pair)
			return True

		if not os.path.exists(jump_file):
			self.explain_why('jump_file %s does not exist!' % jump_file)
			self.build_cat_jump_file(pair)
			return True

		self.explain_why_not('destination %s is up to date' % destination)
		return False

	def remove_php_dirs (self):

		targets = self.products + [(1,i) for i, j in self.find_all_cat_jumps()]

		for target in reversed(sorted(targets)):

			php_file = self.get_php_filename(target)

			if os.path.exists(php_file):
				self.loud('Removing file %s' % php_file)
				os.unlink(php_file)

			clean_empty_dirs(php_file)

	def load_products (self):

		sources = self.find_page_sources()

		for stem in sources:
			self.load_src_file(stem)
			self.load_dep_file(stem)

		return len(sources)

	def build (self):

		sources = self.load_products()

		for stem in self.products:
			self.update_php_file(stem)

		jumps = self.find_all_cat_jumps()
		for pair in jumps:
			self.update_cat_jump_file(pair)

		self.stats('%5d source pages' % sources)
		self.stats('%5d php files' % (len(self.products) + len(jumps)))

	def remove (self):

		try: self.load_products()
		except: return

		for stem in self.products:
			self.remove_php_file(stem)

		self.remove_php_dirs()

