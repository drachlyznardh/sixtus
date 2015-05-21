# encoding: utf-8

from __future__ import print_function

import sys
import re
from .conversion import Content, Full

class TexContent(Content):

	def __init__ (self, page_location):

		Content.__init__(self, page_location)

	def do_make_title (self, grade, direction, content):

		if grade == 'title': tag = 'Large'
		elif grade == 'stitle': tag = 'Huge'

		return '\\bigskip{\\%s %s}\\bigskip\n\n' % (tag, content)

		if direction in ('', 'left'): style = ''
		elif direction == 'center': style = ' class="center"'
		elif direction == 'right': style = ' class="reverse"'

		return '<%s%s>%s</%s>\n' % (tag, style, content, tag)

	def do_start_writing (self, align):

		if self.mode == 'li': return '\\item'
		return '\n'

		if self.mode == 'pre': return ''

		if self.mode == 'p': tag = 'p'
		elif self.mode == 'li': tag = 'li'

		if align == 'p': return '<%s>' % tag
		if align == 'c': return '<%s class="center">' % tag
		if align == 'r': return '<%s class="reverse">' % tag

	def do_stop_writing (self):
		return '\n'

	def do_make_link (self, href, before, text, after, tab):
		return '%s\href{%s}{%s}%s' % (before, href, text, after)

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

		if style == 'ul': output.append('ul')
		elif style == 'ol': output.append('ol class="roman"')
		elif style == 'dl': output.append('ol class="decimal"')

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
		with open(filename, 'w') as f: print('%s' % self.page, file=f)

