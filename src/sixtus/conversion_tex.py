# encoding: utf-8

import sys, re

from .conversion import Content, Full

class TexContent(Content):

	def __init__ (self, page_location):

		Content.__init__(self, page_location)
		self.tids = []

	def escape_line (self, line):
		line = line.replace('\\', '\\textbackslash')
		line = line.replace('&', '\\&')
		line = line.replace('\\\\&amp;', '\\&')
		line = line.replace('$', '\\$')
		line = line.replace('%', '\\%')
		line = line.replace('_', '\\_')
		line = line.replace('~', '\\textasciitilde')
		return line

	def do_make_title (self, grade, direction, text):

		if grade == 'title': tag = 'Large'
		elif grade == 'stitle': tag = 'Huge'

		if direction in ('', 'left'):
			before = '\\begin{flushleft}\n'
			after = '\\end{flushleft}\n'
		elif direction == 'center':
			before = '\\begin{center}\n'
			after = '\\end{center}\n'
		elif direction == 'right':
			before = '\\begin{flushright}\n'
			after = '\\end{flushright}\n'

		return '\n%s\\bigskip{\\%s %s}\n%s' % (before, tag, text, after)

	def do_start_writing (self, align):

		if self.mode == 'li': return '\\item '
		if align == 'c': return '\n\\begin{nscenter}\n'
		if align == 'r': return '\n\\hfill\\ '
		return '\n'

	def do_stop_writing (self):

		if self.align == 'c': return '\n\\end{nscenter}\n\n'
		return '\n'

	def do_make_tid (self, href, before, text, after, tab):
		self.tids.append((before + text + after, tab))
		ref = '%s/tab-%s.tex' % (self.page_location, tab)
		return '\\textbf{%s%s%s}~~\\pageref{%s}' % (before, text, after, ref)

	def do_make_link (self, href, before, text, after):
		return '%s\\href{%s}{%s}%s' % (before, href, text, after)

	def do_make_style (self, c, before, text, after):
		if c == 'em': return '%s\\emph{%s}%s' % (before, text, after)
		if c == 'code': return '%s\\texttt{%s}%s' % (before, text, after)
		if c == 'strong': return '%s\\textbf{%s}%s' % (before, text, after)

	def do_make_decoration (self, c, before, text, after):
		if c == 'spoiler':
			return before+text+after
		elif c == 'wrong':
			return '%s\\sout{%s}%s' % (before, text, after)

	def do_make_speak (self, args):
		dialog = args[1].split('@')
		return '«%s»' % ' – '.join(dialog)

	def do_make_id (self, ref):
		pass

	def do_make_break (self):
		self.content += '\n\\bigskip\n\n'

	def do_make_side (self, side):

		if side == 'inside':
			self.content += '\n\\begin{inside}'
			ending = '\\end{inside}\n'
		elif side == 'outside':
			self.content += '\n\\begin{outside}'
			ending = '\\end{outside}\n'

		self.environment.append((self.mode, ending))

	def do_make_list (self, style, margin, start):

		output = []

		if style == 'ul':
			self.content += '\n\\begin{itemize}\n'
			self.environment.append((self.mode, '\n\\end{itemize}\n'))
		elif style in ('ol', 'dl'):
			self.content += '\n\\begin{enumerate}\n'
			self.environment.append((self.mode, '\n\\end{enumerate}\n'))

		self.mode = 'li'

	def do_make_floating_block (self, style, side):
		envname = style + side
		self.content += '\n\\begin{%s}' % envname
		self.environment.append((self.mode, '\\end{%s}\n' % envname))

	def do_make_style_block (self, style):
		if style == 'em':
			self.content += '{\\bfseries'
		elif style == 'strong':
			self.content += '{\\em'
		elif style == 'code':
			self.content += '{\\ttfamily'
		self.environment.append((self.mode, '}\n\n'))

	def do_make_decoration_block (self, decoration):

		if decoration == 'wrong':
			self.content += '\\sout{'
			self.environment.append((self.mode, '}\n\n'))
		else: self.environment.append((self.mode, '\n'))

	def do_make_pre_block (self):
		self.environment.append((self.mode, '\n'))
		self.mode = 'pre'

	def do_make_clear (self, side):
		pass

class TexFull(Full):

	def __init__ (self, page_location):

		Full.__init__(self, page_location, TexContent(page_location))

	def output_page_file (self, filename):

		self.state_update('meta')
		with open(filename, 'w') as f:
			print('\label{%s}' % filename, file=f)
			print('%s' % self.page, file=f)

