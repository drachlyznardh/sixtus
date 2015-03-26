#!/usr/bin/python
# -*- encoding: utf-8 -*-

from __future__ import print_function
import re
import os

import roman

def read (Six_file):

	re_include = re.compile(r'^source\|(.*)\|.*\n$')
	re_tab     = re.compile(r'^tab\|(.*)\n$')
	re_jump    = re.compile(r'^jump\|(.*)\n$')

	sources = []
	tabs = []

	with open(Six_file, 'r') as f:
		for line in f.readlines():

			if re_include.match(line):
				sources.append(re_include.sub(r'\1', line))
			elif re_tab.match(line):
				tabs.append(re_tab.sub(r'\1', line))
			elif re_jump.match(line):
				return roman.unique(sources), True, []

	return roman.unique(sources), False, roman.unique(tabs)

def digest (jump, tabs):

	bundles = []
	size = len(tabs)

	if jump:
		bundles.append((1, mapped))
	elif size == 0:
		bundles.append((0, mapped))
	elif size == 1:
		bundles.append((1, mapped))
		bundles.append((0, os.path.join(mapped, roman.convert(tabs[0]))))
	else:
		bundles.append((1, mapped))
		bundles.append((2, mapped))
		for name in tabs:
			bundles.append((0, os.path.join(mapped, roman.convert(name))))

	return bundles

def write (dep_file, sources, products):
	
	with open(dep_file, 'w') as f:
		print((source, products), file=f)

def build (Six_file, dep_file):

	sources, jump, tabs = read(Six_file)
	products = digest(jump, tabs)
	write(dep_file, sources, products)
	return sources, products

