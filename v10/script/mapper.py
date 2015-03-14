#!/usr/bin/python
# -*- encoding: utf-8 -*-

from __future__ import print_function
import sys
import os

def get (map_file, page_origin):

	with open(map_file, 'r') as f:
		sitemap = eval(f.read())

	partial = page_origin
	unmapped = []

	while partial and partial not in sitemap:
		token = partial.split('/')
		partial = '/'.join(token[:-1])
		unmapped.append(token[-1])

	translated = sitemap.get(partial, page_origin)
	if len(unmapped):
		return '%s/%s' % (translated, '/'.join(unmapped))
	return translated
