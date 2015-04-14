# encoding: utf-8

from __future__ import print_function
import os

class Sixtus:

	def __init__ (self, bag):

		self.force, self.flags, self.time_delta, self.sitemap, self.loc, self.conf = bag

	def loud (self, message):
		if self.flags.get('loud', False):
			print(message)

	def explain_why (self, message):
		if self.flags.get('why', False):
			print(message)

	def explain_why_not (self, message):
		if self.flags.get('not', False):
			print(message)

