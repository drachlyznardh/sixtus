# encoding: utf-8

from __future__ import print_function
import os

from util import convert

class Base:

	def __init__ (self, bag):

		self.force = bag.force
		self.flags = bag.flags
		self.time_delta = bag.time_delta
		self.sitemap = bag.sitemap
		self.loc = bag.location
		self.conf = bag.conf
		self.version = bag.version

	def loud (self, message):
		if self.flags.get('loud', False):
			print(message)

	def explain_why (self, message):
		if self.flags.get('why', False):
			print(message)

	def explain_why_not (self, message):
		if self.flags.get('not', False):
			print(message)

	def stats (self, message):
		if self.flags.get('stats', False):
			print(message)

	def map_Six_to_six (self, stem):

		discarded = []
		partial = stem

		while partial and partial not in self.sitemap:
			partial, last = os.path.split(partial)
			if last != 'index':
				discarded.append(convert(last))

		translated = self.sitemap.get(partial, '')

		if len(discarded):
			discarded.reverse()
			return os.path.join(translated, os.path.join(*discarded))

		return translated

