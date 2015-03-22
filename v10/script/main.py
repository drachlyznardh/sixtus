#!/usr/bin/python
# encoding: utf-8

from __future__ import print_function
import sys
import os
import fnmatch
import re

def find_all_dirs (source):

	found = []

	for each in os.listdir(source):
		child = os.path.join(source, each)
		if os.path.isdir(child):
			found.append(child)
			found += find_all_dirs(child)

	return found

def find_all_files (root_dir, pattern):

	if not os.path.exists(root_dir):
		print('Specified root_dir [%s] does not exist!' % root_dir, file=sys.stderr)
		sys.exit(1)

	visit = [root_dir] + find_all_dirs(root_dir)
	all_files = []

	for d in visit:
		for f in os.listdir(d):
			if fnmatch.fnmatch(f, pattern):
				all_files.append(os.path.join(d,f))

	return all_files

def assert_dir (filename):

	dirname = os.path.dirname(filename)

	if not os.path.exists(dirname):
		os.makedirs(dirname)

print('Siχtus 0.10')

pag_files = find_all_files ('src', '*.pag')
Six_files = [re.sub(r'^src(.*)\.pag$', r'build\1.Six', i) for i in pag_files]
dep_files = [re.sub(r'(.*)\.Six$', r'\1.dep', i) for i in Six_files]

print('pag_files = %s' % pag_files)
print('Six_files = %s' % Six_files)
print('dep_files = %s' % dep_files)

for Six_file in Six_files:

	if not os.path.exists(Six_file):
		print('Six file [%s] does not exist!' % Six_file)
		pag_file = re.sub(r'^build(.*)\.Six$',r'src\1.pag', Six_file)
		page_base = os.path.dirname(pag_file)
		print('Invoking preprocessor %s %s %s' % (pag_file, page_base, Six_file))

		from preprocessor import Preprocessor
		pp = Preprocessor(page_base)
		pp.parse_file(pag_file)
		assert_dir(Six_file)
		pp.output_file(Six_file)

import deps

for dep_file in dep_files:

	if not os.path.exists(dep_file):
		print('dep file [%s] does not exist!' % dep_file)

		Six_file = re.sub(r'(.*)\.dep', r'\1.Six', dep_file)
		print('Reading dependencies from %s' % Six_file)
		dep_list = deps.extract(Six_file)
		assert_dir(dep_file)
		with open(dep_file, 'w') as f:
			print('(%s, %s, %s)' % dep_list, file=f)

import mapper
import roman

six_dirs  = {}
php_names = []

for dep_file in dep_files:

	with open(dep_file, 'r') as f:
		dep_list = eval(f.read())

	tab_names = dep_list[2]
	tab_files = []

	stem = re.sub(r'build/(.*)\.dep', r'\1', dep_file)
	print('Stem (%10s, %10s, %10s)' % (stem, os.path.dirname(stem), os.path.basename(stem)))

	mapped = '%s' % mapper.get('map.py', os.path.dirname(stem))

	basename = os.path.basename(stem)
	if basename != 'index':
		mapped = os.path.join(mapped, roman.convert(basename))

	size = len(tab_names)
	if size == 0:
		tab_files.append(os.path.join(mapped, 'index'))
	elif size == 1:
		tab_files.append(os.path.join(mapped, 'jump'))
		tab_files.append(os.path.join(mapped, roman.convert(tab_names[0]), 'page'))
	else:
		tab_files.append(os.path.join(mapped, 'jump'))
		tab_files.append(os.path.join(mapped, 'side'))
		for name in tab_names:
			tab_files.append(os.path.join(mapped, roman.convert(name), 'page'))

	six_dirs[mapped] = stem
	php_names += tab_files

for key, value in six_dirs.items():
	print('%s → %s' % (key, value))

six_files = [os.path.join('build', '%s.six' % name) for name in php_names]
php_files = [os.path.join('/opt/web/mobile', '%s.php' % name) for name in php_names]
print('six_files = %s' % six_files)
print('php_files = %s' % php_files)

print('Siχtus 0.10, done')
sys.exit(0)
