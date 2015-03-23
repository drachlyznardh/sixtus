#!/usr/bin/python
# encoding: utf-8

from __future__ import print_function
import sys
import os
import fnmatch
import re

import deps
import mapper
import roman
import converter
from preprocessor import Preprocessor

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

def build_Six_file (Six_file):

	pag_file = re.sub(r'^build(.*)\.Six$',r'src\1.pag', Six_file)
	page_base = os.path.dirname(pag_file)
	print('Invoking preprocessor %s %s %s' % (pag_file, page_base, Six_file))

	pp = Preprocessor(page_base)
	pp.parse_file(pag_file)
	assert_dir(Six_file)
	pp.output_file(Six_file)

def build_dep_file (dep_file):

	Six_file = re.sub(r'(.*)\.dep', r'\1.Six', dep_file)
	print('Reading dependencies from %s' % Six_file)
	dep_list = deps.extract(Six_file)
	assert_dir(dep_file)
	with open(dep_file, 'w') as f:
		print('(%s, %s, %s)' % dep_list, file=f)

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
		build_Six_file(Six_file)

for dep_file in dep_files:

	if not os.path.exists(dep_file):
		print('dep file [%s] does not exist!' % dep_file)
		build_dep_file(dep_file)

six_dirs  = {}
php_names = []

for dep_file in dep_files:

	with open(dep_file, 'r') as f:
		dep_list = eval(f.read())

	tab_names = dep_list[2]
	tab_files = []

	stem = re.sub(r'build/(.*)\.dep', r'\1', dep_file)
	mapped = '%s' % mapper.get('map.py', os.path.dirname(stem))
	basename = os.path.basename(stem)
	if basename != 'index':
		mapped = os.path.join(mapped, roman.convert(basename))

	size = len(tab_names)
	if size == 0:
		tab_files.append(os.path.join(mapped, 'page'))
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

six_files = [os.path.join('build', '%s.six' % name) for name in php_names]
php_files = [os.path.join('/opt/web/mobile', '%s.php' % name) for name in php_names]
print('six_files = %s' % six_files)
print('php_files = %s' % php_files)

for name in php_names:

	six_file = os.path.join('build', '%s.six' % name)
	if not os.path.exists(six_file):
		print('six file %60s does not exist!' % six_file)

		six_dir = os.path.dirname(name)
		while six_dir and six_dir not in six_dirs:
			print('%s does not match' % six_dir)
			six_dir = os.path.dirname(six_dir)

		if six_dir not in six_dirs:
			print('Shit!')
			sys.exit(1)

		print('Match found! %s → %s' % (six_dir, six_dirs[six_dir]))

		Six_file = os.path.join('build', '%s.Six' % six_dirs[six_dir])
		output_dir = os.path.join('build', six_dir)#os.path.dirname(six_dir))

		print('Invoking splitter ("%s", "%s")' % (Six_file, output_dir))
		from splitter import Splitter
		sp = Splitter()
		sp.parse_file(Six_file)
		sp.output_files(output_dir)

page_re = re.compile(r'(.*)page$')
jump_re = re.compile(r'(.*)jump$')
side_re = re.compile(r'(.*)side$')

for name in php_names:

	if page_re.match(name):
		php_type = 0
		php_name = page_re.sub(r'\1index', name)
	elif jump_re.match(name):
		php_type = 1
		php_name = jump_re.sub(r'\1index', name)
	elif side_re.match(name):
		php_type = 2
		php_name = name
	else:
		print('No match on %s' % name)
		sys.exit(1)

	six_file = os.path.join('build', '%s.six' % name)
	php_file = os.path.join('/opt/web/mobile', '%s.php' % php_name)
	if not os.path.exists(php_file):
		print('PHP file %60s does not exist!' % php_file)

		if php_type == 0: # page
			print('Invoking FullConverter (%s,%s,%s)' % (os.path.dirname(php_file), six_file, php_file))
			c = converter.FullConverter(os.path.dirname(php_file))
			c.parse_file(six_file)
			assert_dir(php_file)
			c.output_page_file(php_file)
		elif php_type == 1: # jump
			print('Invoking Jumper (%s,%s)' % (six_file, php_file))

			with open(six_file, 'r') as f:
				token = f.readline().split('|')

			if token[0] != 'jump':
				print('Line does not contain a jump directive! %s' % line, file=sys.stderr)
				sys.exit(1)

			assert_dir(php_file)
			with open(php_file, 'w') as f:
				print('<?php header("Location: /%s");die();?>' % token[1], file=f)

		elif php_type == 2: # side
			print('Invoking Converter (%s,%s,%s)' % (os.path.dirname(php_file), six_file, php_file))

			c = converter.ContentConverter(php_file)

			with open(six_file, 'r') as f:
				for line in f.readlines():
					c.parse_line(line.strip())

			assert_dir(php_file)
			with open(php_file, 'w') as f:
				print(c.content, file=f)

print('Siχtus 0.10, done')
sys.exit(0)
