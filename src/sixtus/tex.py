# encoding: utf-8

from __future__ import print_function

import os
import re

from .util import unique

from .Six import from_pag_to_Six_file
from .dep import from_Six_to_dep_file
from .six import from_Six_to_six_files

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
		target_dir = '%s.d' % target
		from_pag_to_Six_file(target, self.Six_file, False)
		sixes = from_Six_to_dep_file(self.Six_file, False)
		print('%s → %s' % (target, target_dir))
		from_Six_to_six_files(self.Six_file, '', target_dir)
		print('%s' % target)
		for filetype, filepath in sixes:
			if filetype == 0: print('\tConverting %s' % filepath)

	def parse_dir (self, target):
		pass

