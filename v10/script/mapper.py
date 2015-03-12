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

	while partial not in sitemap:
		print('%s not found' % partial)
		partial = '/'.join(partial.split('/'))[:-1]

	return (page_origin, map_capitalize)

class Mapper:

	def __init__ (self, map_file, page_origin):

		self.debug = False

		with open(map_file) as f:
			site_map = eval(f.read())

		if page_origin in site_map:
			self.base = site_map[page_origin]
		else: self.base = page_origin
