#!/usr/bin/python
# encoding: utf-8

from __future__ import print_function
import sys
import os
import re

import util

class Runtime:

	def __init__ (self):

		self.debug = {} #key:True for key in ['explain']}
		self.time_delta = 0.5

		with open('conf.py', 'r') as f:
			self.conf = eval(f.read())

		if 'location' not in self.conf:
			raise Exception('Location does not appear in the configuration')
		self.location = self.conf['location']
		self.location['runtime'] = '/opt/devel/web/sixtus/v10/runtime'

	def copy_static (self, source, destination):

		util.assert_dir(destination)
		with open(destination, 'w') as df:
			with open(source, 'r') as sf:
				print(sf.read(), file=df)

	def replace_line (self, line):

		line = line.replace('@SIXTUS_AUTHOR_NAME@', self.conf.get('author').get('name'))
		line = line.replace('@SIXTUS_AUTHOR_MAIL@', self.conf.get('author').get('mail'))

		line = line.replace('@SIXTUS_COPYRIGHT_OWNER@', self.conf.get('copyright').get('owner'))
		line = line.replace('@SIXTUS_COPYRIGHT_YEARS@', self.conf.get('copyright').get('years'))

		line = line.replace('@SIXTUS_TAB_PREV@', self.conf.get('lang').get('tab').get('prev'))
		link = '<a href="<?=$d[6]?>">%s</a>' % self.conf.get('lang').get('tab').get('prev_title')
		line = line.replace('@SIXTUS_TAB_PREV_TITLE@', link)
		line = line.replace('@SIXTUS_TAB_NEXT@', self.conf.get('lang').get('tab').get('next'))
		link = '<a href="<?=$d[7]?>">%s</a>' % self.conf.get('lang').get('tab').get('next_title')
		line = line.replace('@SIXTUS_TAB_NEXT_TITLE@', link)

		line = line.replace('@SIXTUS_PAGE_PREV@', self.conf.get('lang').get('prev'))
		line = line.replace('@SIXTUS_PAGE_NEXT@', self.conf.get('lang').get('next'))

		line = line.replace('@SIXTUS_SIDE@', self.conf.get('side'))

		return line

	def copy_replace (self, source, destination):

		with open(destination, 'w') as df:
			for line in open(source, 'r').readlines():
				print(self.replace_line(line[:-1]), file=df)

	def update_file (self, name, callback):

		if isinstance (name, str):
			in_file = os.path.join(self.location['runtime'], name)
			out_file = os.path.join(self.location['deploy'], 'sixtus', name)
		elif isinstance (name, tuple):
			in_name, out_name = name
			in_file = os.path.join(self.location['runtime'], in_name)
			out_file = os.path.join(self.location['deploy'], 'sixtus', out_name)
		else:
			raise Exception('What is %s supposed to be?' % name)

		if not os.path.exists(out_file):
			if self.debug.get('explain', False):
				print('out file %s does not exist' % out_file)
			callback(in_file, out_file)
			return True

		in_time = os.path.getmtime(in_file)
		out_time = os.path.getmtime(out_file)
		if in_time - out_time > self.time_delta:
			if self.debug.get('explain', False):
				print('in file %s is more recent than out file %s' % (in_file, out_file))
			callback(in_file, out_file)
			return True

		if self.debug.get('explain', False):
			print('out file %s is up to date' % out_file)
		return False

	def build (self):

		for name in ['icon.ico', 'panel.js', 'style.css']:
			self.update_file(name, self.copy_static)

		for pair in [('page-head.php.in', 'page-top.php'),
				('page-foot.php.in', 'page-bottom.php'),
				('page-waist.php.in', 'page-middle.php')]:
			self.update_file(pair, self.copy_replace)
