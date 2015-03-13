#!/usr/bin/python
# -*- encoding: utf-8 -*-

from __future__ import print_function
import sys
import os

def get (map_file, page_origin):

	with open(map_file, 'r') as f:
		sitemap = eval(f.read())

	partial = page_origin

	while partial and partial not in sitemap:
		partial = '/'.join(partial.split('/')[:-1])

	return sitemap.get(partial, page_origin)
