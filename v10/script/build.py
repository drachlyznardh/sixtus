#!/usr/bin/python
# encoding: utf-8

from __future__ import print_function
import re
import os

import util
import preprocessor
import deps
import mapper
import roman
import converter

def build_Six_file (Six_file):

	pag_file = re.sub(r'^build(.*)\.Six$',r'src\1.pag', Six_file)
	page_base = os.path.dirname(pag_file)
	print('Invoking preprocessor %s %s %s' % (pag_file, page_base, Six_file))

	pp = preprocessor.Preprocessor(page_base)
	pp.parse_file(pag_file)
	util.assert_dir(Six_file)
	pp.output_file(Six_file)

def build_dep_file (dep_file):

	Six_file = re.sub(r'(.*)\.dep', r'\1.Six', dep_file)
	print('Reading dependencies from %s' % Six_file)
	dep_list = deps.extract(Six_file)
	util.assert_dir(dep_file)
	with open(dep_file, 'w') as f:
		print('(%s, %s, %s)' % dep_list, file=f)

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

	return stem, mapped, sources, tab_files

def build_six_files (Six_file, output_dir):

	print('Invoking splitter ("%s", "%s")' % (Six_file, output_dir))
	from splitter import Splitter
	sp = Splitter()
	sp.parse_file(Six_file)
	sp.output_files(output_dir)

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

