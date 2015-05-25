# encoding: utf-8

from __future__ import print_function

import os
import re

from .util import unique, assert_dir

from .Six import from_pag_to_Six_file
from .dep import from_Six_to_dep_file
from .six import from_Six_to_six_files
from .conversion_tex import TexContent, TexFull

def _search_for_target_list (root):

	if not os.path.exists(root):
		raise Exception('Root dir %s does not exist' % root)

	if not os.path.isdir(root):
		raise Exception('Root %s is not a directory' % root)

	pattern = re.compile(r'.*\.pag')

	result = []
	visit = ['']
	while len(visit):
		this_dir = visit.pop(0)
		this_path = os.path.join(root, this_dir)
		for item in sorted(os.listdir(this_path)):
			item_path = os.path.join(this_path, item)
			if os.path.isdir(item_path):
				result.append((0, item_path))
				visit.append(os.path.join(this_dir, item))
			elif pattern.match(item):
				result.append((1, item_path))

	return unique(result)

def _tag_target_list (targets):

	result = []

	for each in unique(targets):
		if not os.path.exists(each):
			raise Exception('Target %s does not exist' % each)
		if os.path.isdir(each):
			result.extend(_search_for_target_list(each))
		else: result.append((1, each))

	return unique(result)

def _get_page_filenames(target_dir, filepath):

	six_file = os.path.join(target_dir, 'tab-%s.six' % filepath)
	tex_file = os.path.join(target_dir, 'tab-%s.tex' % filepath)
	return (six_file, tex_file)

def _get_side_filenames(target_dir, filepath):

	six_file = os.path.join(target_dir, 'side.six')
	tex_file = os.path.join(target_dir, 'side.tex')
	return (six_file, tex_file)

def _from_page_six_to_tex_file (six_file, tex_file):

	c = TexFull('')
	c.parse_file(six_file)
	assert_dir(tex_file)
	c.output_page_file(tex_file)

	return c.meta['title'], c.meta['subtitle']

def _from_side_six_to_tex_file (six_file, tex_file):

	c = TexContent('')

	with open(six_file, 'r') as f:
		for line in f.readlines():
			c.parse_line(line.strip())

	assert_dir(tex_file)
	with open(tex_file, 'w') as f:
		print(c.content, file=f)

	return c.tids

def _from_metadata_to_Makefile (target, tid_list, root_dir):

	main_filename = target.replace('.pag', '.tex')
	make_filename = '%s/Makefile' % root_dir

	srcs = [main_filename, 'side.tex']
	srcs.extend(['tab-%s.tex' % e for d, e in tid_list])

	content  = 'TARGET := %s\n' % main_filename
	content += 'SRCS := %s\n' % ' '.join(srcs)
	content += 'PDF := $(TARGET:.tex=.pdf)\n'
	content += 'all: $(PDF)\n'
	content += '$(PDF):$(SRCS)\n'
	content += '\txelatex $(TARGET)\n'
	content += '\txelatex $(TARGET)\n'

	with open(make_filename, 'w') as f:
		print(content, file=f)

def _list_content (has_side, tid_list):

	if has_side: content = '\\section*{}\n\\input{side.tex}\n'
	else: content = ''
	for title, ref in tid_list:
		content += '\\section{%s}\n\\input{tab-%s.tex}\n' % (title, ref)

	return content

class Tex:

	def __init__ (self, data_dir, author):
		self.six_file = os.path.abspath('.six')
		self.Six_file = os.path.abspath('.Six')
		self.article = os.path.join(data_dir, 'article.tex')
		self.report = os.path.join(data_dir, 'report.tex')
		self.author = author

	def parse (self, targets):

		if len(targets) == 0:
			target_list = _search_for_target_list(os.getcwd())
		else: target_list = _tag_target_list(targets)

		for each in target_list: self.parse_target(each)

	def parse_target (self, seed):
		isfile, target = seed
		if isfile: self.parse_file(target)
		else: self.parse_dir(target)

	def replace_line (self, line):
		line = line.replace('@TITLE@', self.title)
		line = line.replace('@SUBTITLE@', self.subtitle)
		line = line.replace('@AUTHOR@', self.author)
		line = line.replace('@CONTENT@', self.content)
		return line

	def from_metadata_to_main_tex_file (self, filename, root_dir):

		target = os.path.join(root_dir, filename)
		source = self.article

		with open(target, 'w') as f:
			for line in open(source, 'r').readlines():
				print(self.replace_line(line.strip()), file=f)

	def parse_file (self, target):

		tids = []
		has_side = False
		target_dir = '%s.d' % target

		from_pag_to_Six_file(target, self.Six_file, False)
		sixes = from_Six_to_dep_file(self.Six_file, False)
		from_Six_to_six_files(self.Six_file, '', target_dir, False)

		for filetype, filepath in sixes:
			if filetype == 0:
				six_file, tex_file = _get_page_filenames(target_dir, filepath)
				self.title, self.subtitle = _from_page_six_to_tex_file(six_file, tex_file)
			if filetype == 2:
				six_file, tex_file = _get_side_filenames(target_dir, filepath)
				tids += _from_side_six_to_tex_file(six_file, tex_file)
				has_side = True

		self.tid_list = unique(tids)
		self.content = _list_content(has_side, self.tid_list)

		target_tex_file = target.replace('.pag', '.tex')
		_from_metadata_to_Makefile(target_tex_file, self.tid_list, target_dir)
		self.from_metadata_to_main_tex_file(target_tex_file, target_dir)

	def parse_dir (self, target):
		pass

