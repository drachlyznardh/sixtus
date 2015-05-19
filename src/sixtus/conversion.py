# encoding: utf-8

from __future__ import print_function

import sys
import re

from .util import convert

class Content:

	def __init__ (self, page_location):

		self.debug = False

		self.environment = []
		self.writing     = False
		self.written     = False
		self.mode        = 'p'

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

	def split_at_at (self, text):
		if '@' in text:
			s = text.split('@')
			return (s[0], s[1:])
		return (text, [])

	def parse_content (self, command, args):

		if self.debug:
			print('Parse_Content (%s, %s)' % (command, args), file=sys.stderr)

		c, opt = self.split_at_at(command)

		if c == 'link': self.append_content(self.make_link(c, args, False))
		elif c == 'tid': self.append_content(self.make_tid(c, args))
		elif c == 'speak': self.append_content(self.make_speak(c, args))
		elif c in ('p', 'c', 'r'): self.make_paragraph(c, args)
		elif c in ('em', 'code', 'strong'): self.append_content(self.make_style(c, args))
		elif c in ('wrong', 'spoiler'): self.append_content(self.make_decoration(c, args))
		elif c == 'id': self.make_id(c, args)
		elif c == 'br': self.make_break(c, args)
		elif c == 'begin': self.make_begin(c, args)
		elif c == 'end': self.make_end(c, args)
		elif c == 'clear': self.make_clear(c, args)
		elif c == 'tag': pass # Tags are supported, right now…
		elif c in ('title', 'stitle'): self.parse_title(c, opt, args)
		else: self.error('Unknown content c [%s] %s' % (c, args))

	def parse_title (self, c, opt, args):

		if c not in ('title', 'stitle', 'subtitle'):
			self.error('What title is %s supposed to be? %s %s' % (c, opt, args))

		size = len(opt)
		if size == 0: direction = ''
		elif size > 1:
			self.error('Only one direction applicable %s %s %s' % (c, opt, args))
		elif opt[0] not in ('left', 'center', 'right'):
			self.error('What direction is %s supposed to be? %s %s' % (opt[0], c, args))
		else: direction = opt[0]

		content = self.parse_recursive(args)
		self.stop_writing()
		self.content += self.do_make_title(c, direction, content)

	def parse_recursive (self, args):

		c = args[0]

		if len(args) == 1: return c

		if c == 'link': return self.make_link(c, args[1:], False)
		elif c == 'tid': return self.make_tid(c, args[1:])
		elif c == 'speak': return self.make_speak(c, args[1:])
		elif c in ('em', 'code', 'strong'): return self.make_style(c, args[1:])
		elif c in ('wrong', 'spoiler'): return self.make_decoration(c, args[1:])
		else: self.error('Parse_Args: %s is not a valid recursive directived' % args)

	def make_paragraph (self, c, args):
		content = self.parse_recursive(args)
		self.start_writing(c)
		self.append_content(content)

	def start_writing (self, align):
		if self.writing: self.stop_writing()
		self.writing = True
		self.written = False
		self.content += self.do_start_writing(align)

	def stop_writing (self):
		if not self.writing: return
		self.writing = False
		self.written = False
		self.content += self.do_stop_writing()

	def append_content (self, text):

		if self.writing:
			if len(text) == 0: return self.stop_writing()
			if self.written:
				self.content += ' %s' % text
			else:
				self.content += text
				self.written = True
		elif len(text):
			self.start_writing('p')
			self.append_content(text)

	def split_triplet (self, content):

		if '@' not in content:
			return ('', content, '')

		token = content.split('@')
		if len(token) == 2:
			return ('', token[0], token[1])

		return (token[0], token[1], token[2])

	def make_tid (self, c, args):

		size = len(args)
		if size < 2 or size > 3:
			self.error('Tid expects 2-3 args %s' % args)

		tab = convert(args[1])
		href = '/'.join(self.page_location.split('/') + [tab])

		link_args = [href, args[0]]
		if size == 3: link_args.append(args[2])

		return self.make_link ('tid', link_args, tab)

	def make_link (self, c, args, tab):

		if self.debug:
			print('Make_Link (%s)' % args, file=sys.stderr)

		if len(args) == 2: href = args[0]
		else: href = '%s#%s' % (args[0], convert(args[2]))

		if len(args[0]) and href[0] != '/': href = '/%s' % href

		before, text, after = self.split_triplet(args[1])

		return self.do_make_link(href, before, text, after, tab)

	def make_style (self, c, args):
		before, text, after = self.split_triplet(args[0])
		return self.do_make_style(c, before, text, after)

	def make_decoration (self, c, args):
		before, text, after = self.split_triplet(args[0])
		return self.do_make_decoration(c, before, text, after)

	def make_speak (self, c, args):
		if len(args) != 2:
			self.error('speak| excepts 2 arguments %s' % args)
		return self.do_make_speak(args)

	def make_id (self, c, args):
		self.stop_writing()
		self.do_make_id(convert(args[0]))

	def make_break (self, c, args):
		self.stop_writing()
		self.do_make_break()

	def make_begin (self, c, args):
		self.stop_writing()
		self.open_env(args)

	def open_env (self, args):

		env = args[0]

		if env in ('inside', 'outside'): return self.do_make_side(env)
		if env in ('code', 'em', 'strong'): return self.do_make_style_block(env)
		if env in ('wrong', 'spoiler'): return self.do_make_decoration_block(env)
		if env == 'pre': return self.do_make_pre_block()
		if env == 'ul':
			if len(args) != 1:
				self.error('ul# expects 1 arg %s' % args)
			return self.do_make_list(env, 0, 0)

		if env == 'ol' or env == 'dl':
			size = len(args)
			margin = 0
			start = 0
			if size > 3: self.error('%s# expects 1-3 args %s' % (env, args))
			if size > 1: margin = args[1]
			if size > 2: start = args[2]
			return self.do_make_list(env, margin, start)

		if env in ('mini', 'half'):
			if args[1] not in ('left', 'right'):
				self.error('Unknown side %s' % args)
			return self.do_make_floating_block(env, args[1])

		self.error('Unknown environment %s' % args)

	def make_end (self, c, args):
		self.stop_writing()

		try: mode, closure = self.environment.pop()
		except: self.error('There is no environment to close!!! %s' % args)

		self.mode = mode
		self.content += closure

	def make_clear (self, c, args):
		self.stop_writing()
		self.do_make_clear(args[0])

class Full:

	def __init__ (self, page_location, helper):

		self.page_location = page_location
		self.helper = helper

		self.debug = False
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
			else: self.helper.append_content(line);
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

		self.helper.parse_content(token[0], token[1:])

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
			else: self.error('Parse_Meta: %s| expects 0 or 2 arguments %s' % (args[0], args))
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

		self.helper.stop_writing()

		if self.state == 'page':
			self.page += self.helper.content
			self.helper.content = ''
		elif self.state == 'side':
			self.side += self.helper.content
			self.helper.content = ''

		self.state = newstate

