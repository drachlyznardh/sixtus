#!/usr/bin/python
# -*- encoding: utf-8 -*-

from __future__ import print_function
import re
import os

import roman

def read (Six_file):

	re_tab     = re.compile(r'^tab\|(.*)\n$')
	re_jump    = re.compile(r'^jump\|(.*)\n$')

	tabs = []

	with open(Six_file, 'r') as f:
		for line in f.readlines():

			if re_tab.match(line):
				tabs.append(re_tab.sub(r'\1', line))
			elif re_jump.match(line):
				return [(1, '')]

	return digest(roman.unique(tabs))

def digest (tabs):

	size = len(tabs)

	if size == 0: return [(0, '')]
	if size == 1: return [(1, ''), (0, roman.convert(tabs[0]))]
	
	products = [(1, ''), (2, '')]
	for name in tabs:
		products.append((0, roman.convert(name)))

	return products

def write (dep_file, products):
	with open(dep_file, 'w') as f:
		print(products, file=f)

def from_dep_file (dep_file):
	with open(dep_file, 'r') as f:
		return eval(f.read())

def from_Six_to_dep_file (Six_file, dep_file):
	products = read(Six_file)
	write(dep_file, products)
	return products

