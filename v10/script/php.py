#!/usr/bin/python
# encoding: utf-8

from __future__ import print_function
import os

import util
import converter

def from_page_six_to_php_file (php_base, six_file, php_file):

	c = converter.FullConverter(php_base)
	c.parse_file(six_file)
	util.assert_dir(php_file)
	c.output_page_file(php_file)

def from_jump_six_to_php_file (php_base, six_file, php_file):

	with open(six_file, 'r') as f:
		token = f.readline().split('|')

	if token[0] != 'jump':
		print('Line does not contain a jump directive! %s' % line, file=sys.stderr)
		sys.exit(1)

	util.assert_dir(php_file)
	with open(php_file, 'w') as f:
		print('<?php header("Location: /%s");die();?>' % token[1].strip(), file=f)

def from_side_six_to_php_file (php_base, six_file, php_file):

	c = converter.ContentConverter(php_file)

	with open(six_file, 'r') as f:
		for line in f.readlines():
			c.parse_line(line.strip())

	util.assert_dir(php_file)
	with open(php_file, 'w') as f:
		print(c.content, file=f)

