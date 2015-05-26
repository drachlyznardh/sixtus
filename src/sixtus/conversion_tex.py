# encoding: utf-8

from __future__ import print_function

import sys
import re
from .conversion import Content, Full

class TexContent(Content):

	def __init__ (self, page_location):

		Content.__init__(self, page_location)
		self.tids = []

	def do_make_title (self, grade, direction, content):

		if grade == 'title': tag = 'Large'
		elif grade == 'stitle': tag = 'Huge'

		return '\\bigskip{\\%s %s}\\bigskip\n\n' % (tag, content)

		if direction in ('', 'left'): style = ''
		elif direction == 'center': style = ' class="center"'
		elif direction == 'right': style = ' class="reverse"'

		return '<%s%s>%s</%s>\n' % (tag, style, content, tag)

	def do_start_writing (self, align):

		if self.mode == 'li': return '\\item '
		if align == 'c': return '\n\\begin{center}\n'
		if align == 'r': return '\n\\begin{flushright}\n'
		return '\n'

	def do_stop_writing (self):

		if self.align == 'c': return '\n\\end{center}\n'
		if self.align == 'r': return '\n\\end{flushright}\n'
		return '\n'

	def do_make_tid (self, href, before, text, after, tab):
		self.tids.append((before + text + after, tab))
		ref = '%s/tab-%s.tex' % (self.page_location, tab)
		return '\\textbf{%s%s%s}\\hfill\\pageref{%s}' % (before, text, after, ref)

	def do_make_link (self, href, before, text, after):
		return '%s\\href{%s}{%s}%s' % (before, href, text, after)

	def do_make_style (self, c, before, text, after):
		if c == 'em': return '%s\\emph{%s}%s' % (before, text, after)
		if c == 'code': return '%s\\texttt{%s}%s' % (before, text, after)
		if c == 'strong': return '%s\\textbf{%s}%s' % (before, text, after)

	def do_make_decoration (self, c, before, text, after):
		return '%s<span class="%s">%s</span>%s' % (before, c, text, after)

	def do_make_speak (self, args):
		author = args[0]
		dialog = args[1].split('@')
		return '<span title="%s">«%s»</span>' % (author, ' – '.join(dialog))

	def do_make_id (self, ref):
		pass

	def do_make_break (self):
		self.content += '\n\\bigskip\n\n'

	def do_make_side (self, side):
		self.content += '<div class="%s">' % side
		self.environment.append((self.mode, '</div>\n'))

	def do_make_list (self, style, margin, start):

		output = []

		if style == 'ul': output.append('\n\\begin{itemize}\n')
		elif style in ('ol', 'dl'): output.append('\n\\begin{enumerate}\n')

		if margin: output.append('style="margin-left;%s"' % margin)
		if start: output.append('start="%s"' % start)

		self.content += '<%s>' % ' '.join(output)
		self.environment.append((self.mode, '</%s>\n' % style))
		self.mode = 'li'

	def do_make_floating_block (self, style, side):
		self.content += '<div class="%s-%s-out"><div class="%s-%s-in">' % (style, side, style, side)
		self.environment.append((self.mode, '</div></div>\n'))

	def do_make_style_block (self, style):
		self.content += '<div class="%s">' % style
		self.environment.append((self.mode, '</div>\n'))

	def do_make_decoration_block (self, decoration):
		self.content += '<div class="%s">' % decoration
		self.environment.append((self.mode, '</div>\n'))

	def do_make_pre_block (self):
		self.environment.append((self.mode, '\n'))
		self.mode = 'pre'

	def do_make_clear (self, side):

		if len(side) == 0: side = 'both'
		if side != 'left' and side != 'right' and side != 'both':
			self.error('Unknown side for clear# %s' % side)

		self.content += ('<div style="float:none;clear:%s"></div>\n' % side)

class TexFull(Full):

	def __init__ (self, page_location):

		Full.__init__(self, page_location, TexContent(page_location))

	def output_page_file (self, filename):

		self.state_update('meta')
		with open(filename, 'w') as f:
			print('\label{%s}' % filename, file=f)
			print('%s' % self.page, file=f)

