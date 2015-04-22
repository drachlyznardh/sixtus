# encoding: utf-8

from __future__ import print_function
import os

from .util import assert_dir
from .converter import ContentConverter, FullConverter

def from_page_six_to_php_file (php_base, six_file, php_file):

	c = FullConverter(php_base)
	c.parse_file(six_file)
	assert_dir(php_file)
	c.output_page_file(php_file)

def from_jump_six_to_php_file (php_base, six_file, php_file):

	with open(six_file, 'r') as f:
		token = f.readline().split('|')

	if token[0] != 'jump':
		print('Line does not contain a jump directive! %s' % line, file=sys.stderr)
		sys.exit(1)

	from_jump_target_to_php_file (token[1].strip(), php_file)

def from_jump_target_to_php_file (target, php_file):

	assert_dir(php_file)
	with open(php_file, 'w') as f:
		print('<?php header("Location: /%s");die();?>' % target, file=f)

def from_side_six_to_php_file (php_base, six_file, php_file):

	c = ContentConverter(php_base)

	with open(six_file, 'r') as f:
		for line in f.readlines():
			c.parse_line(line.strip())

	assert_dir(php_file)
	with open(php_file, 'w') as f:
		print(c.content, file=f)

