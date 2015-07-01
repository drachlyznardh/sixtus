# encoding: utf-8

from __future__ import print_function

import sys
import re
from .conversion import Content, Full

class PHPContent(Content):

	def __init__ (self, page_location):

		Content.__init__(self, page_location)

	def do_make_title (self, grade, direction, content):

		if grade == 'title': tag = 'h2'
		elif grade == 'stitle': tag = 'h3'

		if direction in ('', 'left'): style = ''
		elif direction == 'center': style = ' class="center"'
		elif direction == 'right': style = ' class="reverse"'

		return '<%s%s>%s</%s>\n' % (tag, style, content, tag)

	def do_start_writing (self, align):

		if self.mode == 'pre': return ''

		if self.mode == 'p': tag = 'p'
		elif self.mode == 'li': tag = 'li'
		elif self.mode == 'h': return ''

		if align == 'p': return '<%s>' % tag
		if align == 'c': return '<%s class="center">' % tag
		if align == 'r': return '<%s class="reverse">' % tag

	def do_stop_writing (self):
		if self.mode == 'p': return '</p>\n'
		if self.mode == 'li': return '</li>\n'
		if self.mode in ('pre', 'h'): return '\n'

	def do_make_tid (self, href, before, text, after, tab):

		if tab: check = '''<?=$d[8]=='%s'?' id="highlighted"':''?>''' % tab
		else: check = ''
		return '%s<a%s href="/%s">%s</a>%s' % (before, check, href, text, after)

	def do_make_link (self, href, before, text, after):
		return '%s<a href="%s">%s</a>%s' % (before, href, text, after)

	def do_make_style (self, c, before, text, after):
		return '%s<%s>%s</%s>%s' % (before, c, text, c, after)

	def do_make_decoration (self, c, before, text, after):
		return '%s<span class="%s">%s</span>%s' % (before, c, text, after)

	def do_make_speak (self, args):
		author = args[0]
		dialog = args[1].split('@')
		return '<span title="%s">«%s»</span>' % (author, ' – '.join(dialog))

	def do_make_id (self, ref):
		self.content += '<a id="%s"></a>\n' % ref

	def do_make_break (self):
		self.content += '<br/>\n'

	def do_make_side (self, side):
		self.content += '<div class="%s">' % side
		self.environment.append((self.mode, '</div>\n'))

	def do_make_list (self, style, margin, start):

		output = []

		if style == 'ul': output.append('ul')
		elif style == 'ol': output.append('ol class="roman"')
		elif style == 'dl': output.append('ol class="decimal"')

		if margin: output.append('style="margin-left:%s"' % margin)
		if start: output.append('start="%s"' % start)

		self.content += '<%s>' % ' '.join(output)
		self.environment.append((self.mode, '</%s>\n' % style))
		self.mode = 'li'

	def do_make_title_block (self, level, side):

		if level == 'title': style = 'h2'
		elif level == 'stitle': style = 'h3'
		output = [style]

		if side == 'center': output.append('class="center"')
		elif side == 'right': output.append('class="reverse"')

		self.content += '<%s>' % ' '.join(output)
		self.environment.append((self.mode, '</%s>' % style))
		self.mode = 'h'

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

class PHPFull(Full):

	def __init__ (self, page_location):

		Full.__init__(self, page_location, PHPContent(page_location))

	def output_page_file (self, filename):

		self.state_update('meta')

		output = '<?php if(!isset($i))$i=array(1,1,1);if($i[0]){$d=array('
		if len(self.page_location):
			loc = self.page_location.split('/')
			output += ('array("%s"),' % ('","'.join(loc)))
		else: output += 'False,'
		output += ('"%s",' % self.meta['title'])
		if 'short' in self.meta: output += ('"%s",' % self.meta['short'])
		else: output += ('"%s",' % self.meta['title'])
		output += ('"%s",' % self.meta['subtitle'])
		if 'prev' in self.meta.keys():
			pagprev = self.meta['prev']
			if pagprev: output += ('array("%s","%s")' % (pagprev[0], pagprev[1]))
			else: output += 'false'
		else: output += 'false'
		output += ','
		if 'next' in self.meta.keys():
			pagnext = self.meta['next']
			if pagnext: output += ('array("%s","%s")' % (pagnext[0], pagnext[1]))
			else: output += 'false'
		else: output += 'false'
		output += ','
		if 'tabprev' in self.meta.keys():
			tabprev = self.meta['tabprev']
			output += ('array("%s","%s")' % (tabprev[0], tabprev[1]))
		else: output += 'false'
		output += ','
		if 'tabnext' in self.meta.keys():
			tabnext = self.meta['tabnext']
			output += ('array("%s","%s")' % (tabnext[0], tabnext[1]))
		else: output += 'false'
		output += ','
		if 'tabself' in self.meta: output += '"%s"' % self.meta['tabself']
		else: output += 'false'
		output += ');'
		output += '$sixtus=$_SERVER["DOCUMENT_ROOT"]."sixtus/";'
		output += 'require_once($sixtus."page-top.php");}if($i[1]){?>'
		output += '\n%s\n' % self.page
		output += '<?php }if($i[0])require_once($sixtus."page-middle.php");'
		if self.side_location:
			output += 'if($i[2])require_once("%s");' % self.side_location
		else: output += 'if($i[2]){?>\n%s\n<?php }' % self.side
		output += 'if($i[0])require_once($sixtus."page-bottom.php");?>'

		with open(filename, 'w') as f: print('%s' % output, file=f)

