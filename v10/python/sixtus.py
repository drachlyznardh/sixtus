#!/usr/bin/python
# encoding: utf-8

from __future__ import print_function

class Sixtus:

	def __init__ (self):

		self.time_delta = 0.5
		self.debug = {key:True for key in ['explain', 'loud']}

	def load_configuration (self, conf_file):

		with open(conf_file, 'r') as f:
			self.conf = eval(f.read())

		self.location = self.conf.get('location')
		self.location['runtime'] = '/opt/devel/web/sixtus/v10/runtime'

	def load_location (self, conf_file):
		with open(conf_file, 'r') as f:
			conf = eval(f.read())

		self.location = conf.get('location')
		self.location['runtime'] = '/opt/devel/web/sixtus/v10/runtime'

	def load_sitemap (self, map_file):
		with open(map_file, 'r') as f:
			self.sitemap = eval(f.read())

	def load_sitematch (self, map_file):
		with open(map_file, 'r') as f:
			sitemap = eval(f.read())

		self.match = sorted(sitemap.values())

	def loud (self, message):
		if self.debug.get('loud', False):
			print(message)

	def explain_why (self, message):
		if self.debug.get('why', False):
			print(message)

	def explain_why_not (self, message):
		if self.debug.get('not', False):
			print(message)

