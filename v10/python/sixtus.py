#!/usr/bin/python
# encoding: utf-8

from __future__ import print_function

class Sixtus:

	def __init__ (self, bag):

		self.debug, self.time_delta, self.sitemap, self.conf = bag

		self.location = self.conf.get('location')
		self.location['runtime'] = '/opt/devel/web/sixtus/v10/runtime'

	def loud (self, message):
		if self.debug.get('loud', False):
			print(message)

	def explain_why (self, message):
		if self.debug.get('why', False):
			print(message)

	def explain_why_not (self, message):
		if self.debug.get('not', False):
			print(message)

