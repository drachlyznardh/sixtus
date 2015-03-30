#!/usr/bin/python
# encoding: utf-8

from __future__ import print_function
import os
import re
import fnmatch

def find_all_sources (root_dir, pattern):

	if not os.path.exists(root_dir):
		raise Exception('Root dir %s does not exist' % root_dir)

	visit = ['']
	result = []
	re_pattern = re.compile(pattern)

	while len(visit):
		this_dir = visit.pop(0)
		for each in os.listdir(os.path.join(root_dir, this_dir)):
			this_name = os.path.join(root_dir, this_dir, each)
			if os.path.isdir(this_name):
				visit.append(os.path.join(this_dir, each))
			elif re_pattern.match(this_name):
				result.append(os.path.splitext(os.path.join(this_dir, each))[0])
	return result

def assert_dir (filename):

	dirname = os.path.dirname(filename)

	if not os.path.exists(dirname):
		os.makedirs(dirname)

