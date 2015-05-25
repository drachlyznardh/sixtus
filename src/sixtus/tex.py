# encoding: utf-8

from __future__ import print_function

import os
import re

from .util import unique, assert_dir

from .Six import from_pag_to_Six_file
from .dep import from_Six_to_dep_file
from .six import from_Six_to_six_files
from .conversion_tex import TexContent, TexFull

def _search_for_target_list (root):

	if not os.path.exists(root):
		raise Exception('Root dir %s does not exist' % root)

	if not os.path.isdir(root):
		raise Exception('Root %s is not a directory' % root)

	pattern = re.compile(r'.*\.pag')

	result = []
	visit = ['']
	while len(visit):
		this_dir = visit.pop(0)
		this_path = os.path.join(root, this_dir)
		for item in sorted(os.listdir(this_path)):
			item_path = os.path.join(this_path, item)
			if os.path.isdir(item_path):
				result.append((0, item_path))
				visit.append(os.path.join(this_dir, item))
			elif pattern.match(item):
				result.append((1, item_path))

	return unique(result)

def _tag_target_list (targets):

	result = []

	for each in unique(targets):
		if not os.path.exists(each):
			raise Exception('Target %s does not exist' % each)
		if os.path.isdir(each):
			result.extend(_search_for_target_list(each))
		else: result.append((1, each))

	return unique(result)

def _get_page_filenames(target_dir, filepath):

	six_file = os.path.join(target_dir, 'tab-%s.six' % filepath)
	tex_file = os.path.join(target_dir, 'tab-%s.tex' % filepath)
	return (six_file, tex_file)

def _get_side_filenames(target_dir, filepath):

	six_file = os.path.join(target_dir, 'side.six')
	tex_file = os.path.join(target_dir, 'side.tex')
	return (six_file, tex_file)

def _from_page_six_to_tex_file (six_file, tex_file):

	c = TexFull('')
	c.parse_file(six_file)
	assert_dir(tex_file)
	c.output_page_file(tex_file)

def _from_side_six_to_tex_file (six_file, tex_file):

	c = TexContent('')

	with open(six_file, 'r') as f:
		for line in f.readlines():
			c.parse_line(line.strip())

	assert_dir(tex_file)
	with open(tex_file, 'w') as f:
		print(c.content, file=f)

class Tex:

	def __init__ (self):
		self.six_file = os.path.abspath('.six')
		self.Six_file = os.path.abspath('.Six')

	def parse (self, targets):

		if len(targets) == 0:
			target_list = _search_for_target_list(os.getcwd())
		else: target_list = _tag_target_list(targets)

		for each in target_list: self.parse_target(each)

	def parse_target (self, seed):
		isfile, target = seed
		if isfile: self.parse_file(target)
		else: self.parse_dir(target)

	def parse_file (self, target):
		tids = []
		target_dir = '%s.d' % target
		from_pag_to_Six_file(target, self.Six_file, False)
		sixes = from_Six_to_dep_file(self.Six_file, False)
		from_Six_to_six_files(self.Six_file, '', target_dir, False)
		for filetype, filepath in sixes:
			if filetype == 0:
				six_file, tex_file = _get_page_filenames(target_dir, filepath)
				_from_page_six_to_tex_file(six_file, tex_file)
			if filetype == 2:
				six_file, tex_file = _get_side_filenames(target_dir, filepath)
				_from_side_six_to_tex_file(six_file, tex_file)

	def parse_dir (self, target):
		pass

