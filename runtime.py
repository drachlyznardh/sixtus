# encoding: utf-8

from __future__ import print_function
import sys
import os
import re

from base import Base
import util

class Runtime(Base):

	def __init__ (self, bag):

		Base.__init__(self, bag)

		self.static_files = ['icon.ico', 'panel.js', 'style.css']
		self.dynamic_files = [('page-head.php.in', 'page-top.php'), ('page-foot.php.in', 'page-bottom.php'), ('page-waist.php.in', 'page-middle.php')]

	def copy_static (self, source, destination):

		util.assert_dir(destination)
		with open(destination, 'w') as df:
			with open(source, 'r') as sf:
				print(sf.read(), file=df)

	def replace_relations (self, line):

		if '@SIXTUS_PAGE_PREV@' in line:

			prev_conf = self.conf.get('lang').get('page').get('prev')

			title = prev_conf.get('title')
			if '@SIXTUS_PAGE_PREV_TITLE@' in title:
				title = title.replace('@SIXTUS_PAGE_PREV_TITLE@', "'.$d[4][1].'")

			link = '<a href="/%s">%s</a>' % ("'.$d[4][0].'", title)
			body = prev_conf.get('body').replace('@SIXTUS_PAGE_PREV_LINK@', link)
			line = line.replace('@SIXTUS_PAGE_PREV@', body)

		if '@SIXTUS_PAGE_NEXT@' in line:

			next_conf = self.conf.get('lang').get('page').get('next')

			title = next_conf.get('title')
			if '@SIXTUS_PAGE_NEXT_TITLE@' in title:
				title = title.replace('@SIXTUS_PAGE_NEXT_TITLE@', "'.$d[5][1].'")

			link = '<a href="/%s">%s</a>' % ("'.$d[5][0].'", title)
			body = next_conf.get('body').replace('@SIXTUS_PAGE_NEXT_LINK@', link)
			line = line.replace('@SIXTUS_PAGE_NEXT@', body)

		if '@SIXTUS_TAB_PREV@' in line:

			prev_conf = self.conf.get('lang').get('tab').get('prev')

			title = prev_conf.get('title')
			if '@SIXTUS_TAB_PREV_TITLE@' in title:
				title = title.replace('@SIXTUS_TAB_PREV_TITLE@', "'.$d[6].'")

			link = '<a href="%s">%s</a>' % ("'.$d[6].'", title)
			body = prev_conf.get('body').replace('@SIXTUS_TAB_PREV_LINK@', link)
			line = line.replace('@SIXTUS_TAB_PREV@', body)

		if '@SIXTUS_TAB_NEXT@' in line:

			next_conf = self.conf.get('lang').get('tab').get('next')

			title = next_conf.get('title')
			if '@SIXTUS_TAB_NEXT_TITLE@' in title:
				title = title.replace('@SIXTUS_TAB_NEXT_TITLE@', "'.$d[7].'")

			link = '<a href="%s">%s</a>' % ("'.$d[7].'", title)
			body = next_conf.get('body').replace('@SIXTUS_TAB_NEXT_LINK@', link)
			line = line.replace('@SIXTUS_TAB_NEXT@', body)

		return line

	def replace_line (self, line):

		line = line.replace('@SIXTUS_FEED_FILE@', self.conf.get('location').get('feed'))

		line = line.replace('@SIXTUS_AUTHOR_NAME@', self.conf.get('author').get('name'))
		line = line.replace('@SIXTUS_AUTHOR_MAIL@', self.conf.get('author').get('mail'))

		line = line.replace('@SIXTUS_COPYRIGHT_OWNER@', self.conf.get('copyright').get('owner'))
		line = line.replace('@SIXTUS_COPYRIGHT_YEARS@', self.conf.get('copyright').get('years'))

		line = line.replace('@SIXTUS_SIDE@', self.conf.get('side'))

		return self.replace_relations(line)

	def copy_replace (self, source, destination):

		with open(destination, 'w') as df:
			for line in open(source, 'r').readlines():
				print(self.replace_line(line[:-1]), file=df)

	def remove_file (self, name):

		if isinstance (name, str):
			out_file = os.path.join(self.loc['deploy'], 'sixtus', name)
		elif isinstance (name, tuple):
			out_file = os.path.join(self.loc['deploy'], 'sixtus', name[1])
		else:
			raise Exception('What is %s supposed to be?' % (name))

		if os.path.exists(out_file):
			self.loud('Removing system file %s' % out_file)
			os.unlink(out_file)

		util.clean_empty_dirs(out_file)

	def update_file (self, name, callback):

		if isinstance (name, str):
			in_file = os.path.join(self.loc['runtime'], name)
			out_file = os.path.join(self.loc['deploy'], 'sixtus', name)
		elif isinstance (name, tuple):
			in_name, out_name = name
			in_file = os.path.join(self.loc['runtime'], in_name)
			out_file = os.path.join(self.loc['deploy'], 'sixtus', out_name)
		else:
			raise Exception('What is %s supposed to be?' % name)

		if self.force:
			self.explain_why('Force rebuild of resource file %s' % out_file)
			callback(in_file, out_file)
			return True

		if not os.path.exists(out_file):
			self.explain_why('resource file %s does not exist' % out_file)
			callback(in_file, out_file)
			return True

		in_time = os.path.getmtime(in_file)
		out_time = os.path.getmtime(out_file)
		if in_time - out_time > self.time_delta:
			self.explain_why('source file %s is more recent than resource file %s' % (in_file, out_file))
			callback(in_file, out_file)
			return True

		self.explain_why_not('out file %s is up to date' % out_file)
		return False

	def build (self):

		for name in self.static_files:
			self.update_file(name, self.copy_static)

		for pair in self.dynamic_files:
			self.update_file(pair, self.copy_replace)

		sources = len(self.static_files) + len(self.dynamic_files)
		self.stats('%03d runtime files' % sources)

	def remove (self):

		for name in self.static_files:
			self.remove_file(name)

		for pair in self.dynamic_files:
			self.remove_file(pair)
