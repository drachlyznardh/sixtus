# encoding: utf-8

from __future__ import print_function
import sys
import os
import re

from .base import Base
from .util import assert_dir, clean_empty_dirs, find_all_sources

class Resources(Base):

	def __init__ (self, bag):

		Base.__init__(self, bag)

	def copy_file (self, source, destination):

		self.loud('Copying resource file %s to %s' % (source, destination))

		assert_dir(destination)
		with open(destination, 'w') as df:
			with open(source, 'r') as sf:
				print(sf.read(), file=df)

	def remove_file (self, name):

		out_file = os.path.join(self.loc['deploy'], self.map_Six_to_six(name))

		if os.path.exists(out_file):
			self.loud('Removing resources file %s' % out_file)
			os.unlink(out_file)

		clean_empty_dirs(out_file)

	def update_file (self, name):

		in_file = os.path.join(self.loc['res'], name)
		out_file = os.path.join(self.loc['deploy'], self.map_Six_to_six(name))

		if self.force:
			self.explain_why('Force rebuild of resource file %s' % out_file)
			self.copy_file(in_file, out_file)
			return True

		if not os.path.exists(out_file):
			self.explain_why('resource file %s does not exist' % out_file)
			self.copy_file(in_file, out_file)
			return True

		in_time = os.path.getmtime(in_file)
		out_time = os.path.getmtime(out_file)
		if in_time - out_time > self.time_delta:
			self.explain_why('origin file %s is more recent than resource file %s' % (in_file, out_file))
			self.copy_file(in_file, out_file)
			return True

		self.explain_why_not('resource file %s is up to date' % out_file)
		return False

	def build (self):

		if 'res' not in self.loc: return

		sources = find_all_sources(self.loc['res'], r'^(.*)$', False)

		for name in sources:
			self.update_file(name)

		self.stats('%03d resource files' % len(sources))

	def remove (self):

		if 'res' not in self.loc: return

		for name in find_all_sources(self.loc['res'], r'^(.*)$', False):
			self.remove_file(name)

