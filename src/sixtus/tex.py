# encoding: utf-8

from __future__ import print_function

import os
import re

def _search_for_targets (root):

	if not os.path.exists(root):
		raise Exception('Root dir %s does not exist' % root)

	if not os.path.isdir(root):
		raise Exception('Root %s is not a directory' % root)

	pattern = re.compile(r'.*\.(pag|six)')

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

	return result

class Tex:

	def __init__ (self):
		pass

	def parse (self, targets):
		if len(targets):
			for target in targets:
				print('Target %s' % target)
		else:
			root = os.getcwd()
			print('Empty target, using current dir %s' % root)
			target_list = _search_for_targets(root)
			for each in target_list: print(each)

