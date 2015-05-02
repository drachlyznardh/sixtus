# -*- encoding: utf-8 -*-

from __future__ import print_function

import sys
import re

from .util import convert

class ContentConverter:

	def __init__ (self, page_location):

		self.debug = False

		self.environment = []
		self.writing     = False
		self.p_or_li     = True

		self.page_location = page_location

		self.content  = ''
		self.filename = ''
		self.lineno   = 0

	def error (self, message):

		line = '\nContentConverter: %s @line %d: %s' % (self.filename, self.lineno, message)
		print(line, file=sys.stderr)
		sys.exit(1)

	def parse_line (self, line):

		self.lineno += 1

		if self.debug:
			print('Parse_Line (%s)' % (line), file=sys.stderr)

		if '|' not in line:
			self.append_content(line);
			return

		token = line.split('|')
		command = token[0]

		if command == 'source':
			self.filename = token[1]
			self.lineno = int(token[2])
			return

		self.parse_content(token[0], token[1:])

	def parse_content (self, c, args):

		if self.debug:
			print('Parse_Content (%s, %s)' % (c, args), file=sys.stderr)

		if c == 'link':
			self.append_content(self.make_link(args))
		elif c == 'tid':
			self.append_content(self.make_tid(args))
		elif c == 'speak':
			self.append_content(self.make_speak(args))
		elif c == 'p' or c == 'c' or c == 'r':
			self.start_writing(c, self.parse_recursive(args))
		elif c == 'id':
			self.stop_writing()
			self.content += ('<a id="%s"></a>\n' % args[0])
		elif c == 'br':
			self.stop_writing()
			self.content += '<br/>\n'
		elif c == 'begin':
			self.stop_writing()
			self.open_env(args)
		elif c == 'clear':
			self.stop_writing()
			self.make_clear(args)
		elif c == 'end':
			self.stop_writing()
			self.close_env(args)
		elif c == 'tag':
			pass # Tags are supported, right now…
		elif c == 'title' or c == 'stitle' or '@' in c:
			self.parse_title(c, args)
		else: self.error('Unknown content c [%s] %s' % (c, args))

	def parse_title (self, command, args):

			option = command.split('@')
			c = option[0]

			if c == 'title': tag = 'h2'
			elif c == 'stitle': tag = 'h3'
			else: self.error('What title is %s supposed to be? %s %s' % (c, command, args))

			if len(option) == 1 or option[1] == 'left': direction = False
			elif option[1] == 'center': direction = 'class="center"'
			elif option[1] == 'right': direction = 'class="reverse"'
			else: self.error('What direction is %s supposed to be? %s %s' % (option[1], command, args))

			content = self.parse_recursive(args)
			self.stop_writing()
			if direction:
				self.content += '<%s %s>%s</%s>\n' % (tag, direction, content, tag)
			else:
				self.content += '<%s>%s</%s>\n' % (tag, content, tag)

	def parse_recursive (self, args):

		if len(args) == 1: return args[0]

		if args[0] == 'link':
			return self.make_link(args[1:])
		elif args[0] == 'tid':
			return self.make_tid(args[1:])

			linkargs = []
			linkargs.append('/%s/%s/' % (self.page_location, args[2].upper()))
			linkargs.append(args[1])
			if len(args) > 3: linkargs.append(args[3:])
			return self.make_link(linkargs)
		elif args[0] == 'speak':
			return self.make_speak(args[1:])
		else: self.error('Parse_Args: not a [link|tid]! %s' % args)

	def start_writing (self, type, text):

		if self.writing: self.stop_writing()

		if self.p_or_li: tag = 'p'
		else: tag = 'li'

		if type == 'p':
			self.content += ('<%s>%s' % (tag, text))
		elif type == 'c':
			self.content += ('<%s class="center">%s' % (tag, text))
		elif type == 'r':
			self.content += ('<%s class="reverse">%s' % (tag, text))

		self.writing = True

	def stop_writing (self):

		if not self.writing: return

		if self.p_or_li:
			self.content += '</p>\n'
		else:
			self.content += '</li>\n'

		self.writing = False

	def append_content (self, text):

		if self.writing:
			if len(text) == 0: self.stop_writing()
			else: self.content += (' %s' % text)
		elif len(text): self.start_writing('p', text)

	def make_tid (self, args):

		size = len(args)

		if size < 2 or size > 3:
			self.error('Tid expects 2-3 args %s' % args)

		tab_location = '/'.join(self.page_location.split('/') + [convert(args[1])])

		link_args = [tab_location, args[0]]
		if size == 3: link_args.append(args[2])

		return self.make_link (link_args)

	def make_link (self, args):

		if self.debug:
			print('Make_Link (%s)' % args, file=sys.stderr)

		if len(args) == 2: href = args[0]
		else: href = '%s#%s' % (args[0], args[2])

		if len(args[0]) and href[0] != '/': href = '/%s' % href

		if '@' not in args[1]:
			title = args[1]
			prev = next = ''
		else:
			token = args[1].split('@')
			if len(token) == 2:
				prev = ''
				title = token[0]
				next = token[1]
			else:
				prev = token[0]
				title = token[1]
				next = token[2]

		return '%s<a href="%s">%s</a>%s' % (prev, href, title, next)

	def make_speak (self, args):

		if len(args) != 2:
			self.error('speak# excepts 2 arguments %s' % args)

		return '<span title="%s">«%s»</span>' % (args[0], ' – '.join(args[1].split('@')))

	def open_env (self, args):

		env = args[0]

		if env == 'inside':
			self.content += '<div class="inside">'
			self.environment.append((self.p_or_li, '</div>'))
		elif env == 'outside':
			self.content += '<div class="outside">'
			self.environment.append((self.p_or_li, '</div>'))

		elif env == 'ul':
			if len(args) != 1:
				self.error('ul# expects 1 arg %s' % args)
			self.content += '<ul>'
			self.environment.append((self.p_or_li, '</ul>'))
			self.p_or_li = False

		elif env == 'ol' or env == 'dl':

			size = len(args)

			if size > 3:
				self.error('%s# expects 1-3 args %s' % (env, args))

			output = []

			if env == 'ol': output.append('class="roman"')
			else: output.apppend('class="decimal"')

			if size > 1: output.append('style="margin-left:%s"' % args[1])
			if size > 2: output.append('start="%s"' % args[2])

			self.content += ('<ol %s>' % ' '.join(output))
			self.environment.append((self.p_or_li, '</ol>\n'))
			self.p_or_li = False

		elif env == 'mini' or env == 'half':
			side = args[1]
			if side != 'left' and side != 'right':
				self.error('Unknown side %s' % args)
			self.content += '<div class="%s-%s-out"><div class="%s-%s-in">' % (env, side, env, side)
			self.environment.append((self.p_or_li, '</div></div>\n'))

		else: self.error('Unknown environment %s' % args)

	def close_env (self, args):

		try: p_or_li, closure = self.environment.pop()
		except: self.error('There is no environment to close!!! %s' % args)

		self.p_or_li = p_or_li
		self.content += closure

	def make_clear (self, args):

		side = args[0]
		if len(side) == 0: side = 'both'
		if side != 'left' and side != 'right' and side != 'both':
			self.error('Unknown side for clear# %s' % args)

		self.content += ('<div style="float:none;clear:%s"></div>\n' % side)

class FullConverter(ContentConverter):

	def __init__ (self, page_location):

		ContentConverter.__init__(self, page_location)

		self.meta = {}
		self.state = 'meta'

		self.page = ''
		self.side = ''
		self.side_location = False

	def error (self, message):

		print('\nFullConverter: %s @line %d: %s' % (self.filename, self.lineno, message), file=sys.stderr)
		sys.exit(1)

	def parse_file (self, filename):

		if self.debug:
			print('Parsing file %s' % filename, file=sys.stderr)

		self.filename = filename
		self.lineno = 0

		f = open(filename, 'r')
		for line in f:
			self.lineno += 1
			self.parse_line(line.strip())

		return self

	def parse_line (self, line):

		if self.debug:
			print('Parse_Line (%s)' % (line), file=sys.stderr)

		if '|' not in line:
			if self.state == 'meta': pass
			else: self.append_content(line);
			return

		token = line.split('|')
		command = token[0]

		if command == 'source':
			self.filename = token[1]
			self.lineno = int(token[2])
			return

		if command == 'start':
			self.state_update(token[1])
			return

		if self.state == 'meta':
			self.parse_meta(token[0], token[1:])
			return

		self.parse_content(token[0], token[1:])

	def parse_meta (self, c, args):

		if self.debug:
			print('Parse_Meta (%s, %s)' % (c, args), file=sys.stderr)

		if c == 'jump':
			self.jump = args[0]
		elif c == 'side':
			self.side_location = args[0]
		elif c == 'title':
			self.meta['title'] = args[0]
			if len(args) == 2: self.meta['subtitle'] = args[1]
		elif c == 'short':
			self.meta['short'] = args[0]
		elif c == 'subtitle':
			self.meta['subtitle'] = args[0]
		elif c == 'prev' or c == 'next':
			size = len(args)
			if size == 1 and args[0] == '': self.meta[c] = False
			elif size == 2: self.meta[c] = (args[0], args[1])
			else: self.error('Parse_Meta: %s# expects 0 or 2 arguments %s' % args)
		elif c == 'tabprev':
			self.meta['tabprev'] = (args[0], args[1])
		elif c == 'tabself':
			self.meta['tabself'] = args[0]
		elif c == 'tabnext':
			self.meta['tabnext'] = (args[0], args[1])
		elif c == 'tag':
			pass # Tags are supported, right now…
		else:
			self.error('Unknown meta c [%s] %s' % (c, args))

	def state_update (self, newstate):

		self.stop_writing()

		if self.state == 'page':
			self.page += self.content
			self.content = ''
		elif self.state == 'side':
			self.side += self.content
			self.content = ''

		self.state = newstate

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

