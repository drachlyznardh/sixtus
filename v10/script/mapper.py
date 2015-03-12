#!/usr/bin/python
# -*- encoding: utf-8 -*-

from __future__ import print_function
import sys
import os

def map_capitalize (name):
	return name.capitalize()

def map_upper (name):
	return name.upper()

def get (map_file, page_origin):

	with open(map_file, 'r') as f:
		sitemap = eval(f.read())

	partial = page_origin

	while partial and partial not in sitemap:
		partial = '/'.join(partial.split('/')[:-1])

	if partial in sitemap:
		value = sitemap[partial]
		if value[1]: func = map_capitalize
		else: func = map_upper
		name = '%s/%s' % (value[0], page_origin[len(partial):])
		return (name, func)

	return (page_origin, map_capitalize)
