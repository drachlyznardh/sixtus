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

import util
import build

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

def parse_dep_file (dep_file):

	with open(dep_file, 'r') as f:
		jump, sources, tab_names = eval(f.read())

	tab_files = []

	stem = re.sub(r'build/(.*)\.dep', r'\1', dep_file)
	mapped = '%s' % mapper.get('map.py', os.path.dirname(stem))
	basename = os.path.basename(stem)
	if basename != 'index':
		mapped = os.path.join(mapped, roman.convert(basename))

	size = len(tab_names)
	if jump:
		tab_files.append((1, mapped))
	elif size == 0:
		tab_files.append((0, mapped))
	elif size == 1:
		tab_files.append((1, mapped))
		tab_files.append((0, os.path.join(mapped, roman.convert(tab_names[0]))))
	else:
		tab_files.append((1, mapped))
		tab_files.append((2, mapped))
		for name in tab_names:
			tab_files.append((0, os.path.join(mapped, roman.convert(name))))

	return mapped, stem, tab_files

for dep_file in dep_files:

	mapped, stem, tab_files = parse_dep_file(dep_file)

	six_dirs[mapped] = stem
	php_names += tab_files

six_files = [util.get_six_filename(bundle) for bundle in php_names]
php_files = [util.get_php_filename(bundle) for bundle in php_names]
print('six_files = %s' % six_files)
print('php_files = %s' % php_files)

def build_six_files (Six_file, output_dir):

	print('Invoking splitter ("%s", "%s")' % (Six_file, output_dir))
	from splitter import Splitter
	sp = Splitter()
	sp.parse_file(Six_file)
	sp.output_files(output_dir)

def locate_six_dir (dirname):

	six_dir = os.path.dirname(name)
	while six_dir and six_dir not in six_dirs:
		print('%s does not match' % six_dir)
		six_dir = os.path.dirname(six_dir)

	if six_dir not in six_dirs:
		print('Shit!')
		sys.exit(1)

	return six_dir

for name in six_files:

	six_file = os.path.join(build_dir, name)
	if not os.path.exists(six_file):
		print('six file %60s does not exist!' % six_file)

		six_dir = locate_six_dir(os.path.dirname(name))

		print('Match found! "%s" → "%s"' % (six_dir, six_dirs[six_dir]))

		Six_file = os.path.join('build', '%s.Six' % six_dirs[six_dir])
		output_dir = os.path.join('build', six_dir)

		build_six_files(Six_file, output_dir)

def build_page_file (php_base, six_file, php_file):

	print('Invoking FullConverter (%s,%s,%s)' % (os.path.dirname(php_file), six_file, php_file))
	c = converter.FullConverter(os.path.dirname(php_file))
	c.parse_file(six_file)
	util.assert_dir(php_file)
	c.output_page_file(php_file)

def build_jump_file (php_base, six_file, php_file):

	print('Invoking Jumper (%s,%s)' % (six_file, php_file))

	with open(six_file, 'r') as f:
		token = f.readline().split('|')

	if token[0] != 'jump':
		print('Line does not contain a jump directive! %s' % line, file=sys.stderr)
		sys.exit(1)

	util.assert_dir(php_file)
	with open(php_file, 'w') as f:
		print('<?php header("Location: /%s");die();?>' % token[1], file=f)

def build_side_file (php_base, six_file, php_file):

	print('Invoking Converter (%s,%s,%s)' % (os.path.dirname(php_file), six_file, php_file))

	c = converter.ContentConverter(php_file)

	with open(six_file, 'r') as f:
		for line in f.readlines():
			c.parse_line(line.strip())

	util.assert_dir(php_file)
	with open(php_file, 'w') as f:
		print(c.content, file=f)

for bundle in php_names:

	php_type = bundle[0]
	php_base = bundle[1]
	six_file = os.path.join(build_dir, util.get_six_filename(bundle))
	php_file = os.path.join(deploy_dir, util.get_php_filename(bundle))

	if not os.path.exists(php_file):
		print('PHP file %60s does not exist!' % php_file)

		if php_type == 0: # page
			build_page_file(php_base, six_file, php_file)
		elif php_type == 1: # jump
			build_jump_file(php_base, six_file, php_file)
		elif php_type == 2: # side
			build_side_file(php_base, six_file, php_file)

print('Siχtus 0.10, done')
sys.exit(0)
