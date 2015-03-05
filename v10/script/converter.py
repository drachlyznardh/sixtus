#!/usr/bin/python
# -*- encoding: utf-8 -*-

from __future__ import print_function

import sys
import re

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

		line = '%s @line %d: %s' % (self.filename, self.lineno, message)
		print(line, file=sys.stderr)
		sys.exit(1)

	def parse_line (self, line):

		self.lineno += 1

		if self.debug:
			print('Parse_Line (%s)' % (line), file=sys.stderr)

		if '#' not in line:
			self.append_content(line);
			return

		token = line.split('#')
		command = token[0]

		if command == 'source':
			self.filename = token[1]
			self.lineno = int(token[2])
			return

		self.parse_content(token[0], token[1:])

	def parse_content (self, command, args):

		if self.debug:
			print('Parse_Content (%s, %s)' % (command, args), file=sys.stderr)

		if command == 'title' or command == 'title@left':
			self.stop_writing()
			self.content += ('<h2>%s</h2>' % self.parse_args(args))
		elif command == 'title@right':
			self.stop_writing()
			self.content += ('<h2 class="reverse">%s</h2>' % self.parse_args(args))
		elif command == 'stitle' or command == 'stitle@left':
			self.stop_writing()
			self.content += ('<h3>%s</h3>' % self.parse_args(args))
		elif command == 'stitle@right':
			self.stop_writing()
			self.content += ('<h3 class="reverse">%s</h3>' % self.parse_args(args))
		elif command == 'link':
			self.append_content(self.make_link(args))
		elif command == 'speak':
			self.append_content(self.make_speak(args))
		elif command == 'p' or command == 'c' or command == 'r':
			self.start_writing(command, self.parse_args(args))
		elif command == 'id':
			self.stop_writing()
			self.content += ('<a id="%s"></a>' % args[0])
		elif command == 'img':
			self.stop_writing()
			self.content += self.make_image(args)
		elif command == 'br':
			self.stop_writing()
			self.content += '<br/>'
		elif command == 'begin':
			self.stop_writing()
			self.open_env(args)
		elif command == 'clear':
			self.stop_writing()
			self.make_clear(args)
		elif command == 'end':
			self.stop_writing()
			self.close_env(args)
		else: self.error('Unknown command [%s] %s' % (command, args))

	def parse_args (self, args):

		if len(args) == 1: return args[0]

		if args[0] == 'link':
			return self.make_link(args[1:])
		elif args[0] == 'tid':
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

		if type == 'p':
			self.content += ('<p>%s' % text)
		elif type == 'c':
			self.content += ('<p class="center">%s' % text)
		elif type == 'r':
			self.content += ('<p class="reverse">%s' % text)

		self.writing = True

	def stop_writing (self):

		if not self.writing: return

		if self.p_or_li:
			self.content += '</p>'
		else:
			self.content += '</li>'

		self.writing = False

	def append_content (self, text):

		if self.writing:
			if len(text): self.content += (' %s' % text)
			else: self.stop_writing()
		elif self.p_or_li:
			self.content += ('<p>%s' % text)
		else:
			self.content += ('<li>%s' % text)

		self.writing = True

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

	def make_image (self, args):

		size = len(args)
		if size == 1:
			src = thumb = args[0]
		elif size == 2:
			src = args[0]
			thumb = args[1]
		else: self.error('img# espects one or two args %s' % args)

		return '<p class="image"><a target="_blank" href="%s" class="image"><img src="%s" /></a></p>' % (src,
		thumb)

	def open_env (self, args):

		env = args[0]

		if env == 'inside':
			self.content += '<div class="inside">'
			self.environment.append((self.p_or_li, '</div>'))
		elif env == 'outside':
			self.content += '<div class="outside">'
			self.environment.append((self.p_or_li, '</div>'))

		elif env == 'ul' or env == 'ol':
			if len(args) != 1:
				self.error('Missing support!!! %s' % args)
			self.content += '<%s>' % env
			self.environment.append((self.p_or_li, '</%s>' % env))
			self.p_or_li = False

		elif env == 'mini' or env == 'half':
			side = args[1]
			if side != 'left' and side != 'right':
				self.error('Unknown side %s' % args)
			self.content += '<div class="%s-%s-out"><div class="%s-%s-in">' % (env, side, env, side)
			self.environment.append((self.p_or_li, '</div></div>'))

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

		self.content += ('<div style="float:none;clear:%s"></div>' % side)

class FullConverter(ContentConverter):

	def __init__ (self, page_location):

		ContentConverter.__init__(self, page_location)

		self.meta = {}
		self.state = 'meta'

		self.page = ''
		self.side = ''
		self.side_location = False

	def error (self, message):

		print('%s @line %d: %s' % (self.filename, self.lineno, message), file=sys.stderr)
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

		self.lineno += 1

		if self.debug:
			print('Parse_Line (%s)' % (line), file=sys.stderr)

		if '#' not in line:
			self.append_content(line);
			return

		token = line.split('#')
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

	def parse_meta (self, command, args):

		if self.debug:
			print('Parse_Meta (%s, %s)' % (command, args), file=sys.stderr)

		if command == 'jump':
			self.jump = args[0]
		elif command == 'side':
			self.sideinclude = args[0]
		elif command == 'title':
			self.meta['title'] = args[0]
		elif command == 'subtitle':
			self.meta['subtitle'] = args[0]
		elif command == 'prev':
			try: self.meta['prev'] = (args[0], args[1])
			except: self.error('Parse_Meta/Prev: need two arguments')
		elif command == 'next':
			try: self.meta['next'] = (args[0], args[1])
			except: self.error('Parse_Meta/Next: need two arguments')
		elif command == 'tabprev':
			self.meta['tabprev'] = args[0]
		elif command == 'tabnext':
			self.meta['tabnext'] = args[0]
		else:
			self.error('Unknown command %s' % args)

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
		output += ('array("%s"),' % ('","'.join(self.page_location.split('/'))))
		output += ('"%s","%s",' % (self.meta.get('title','title'), self.meta.get('subtitle','subtitle')))
		if 'prev' in self.meta.keys():
			pagprev = self.meta['prev']
			output += ('array("%s","%s")' % (pagprev[0], pagprev[1]))
		else: output += 'false'
		output += ','
		if 'next' in self.meta.keys():
			pagnext = self.meta['next']
			output += ('array("%s","%s")' % (pagnext[0], pagnext[1]))
		else: output += 'false'
		output += ','
		if 'tabprev' in self.meta.keys():
			tabprev = self.meta['tabprev']
			output += ('"%s"' % tabprev)
		else: output += 'false'
		output += ','
		if 'tabnext' in self.meta.keys():
			tabnext = self.meta['tabnext']
			output += ('"%s"' % tabnext)
		else: output += 'false'
		output += ');'
		output += '$sixtus=$_SERVER["DOCUMENT_ROOT"]."sixtus/";'
		output += 'require_once($sixtus."page-top.php");}if($i[1]){?>'
		output += '%s' % self.page
		output += '<?php }if($i[0])require_once($sixtus."page-middle.php");'
		if self.side_location:
			output += 'if($i[2])require_once("%s");' % self.side_location
		else: output += 'if($i[2]){?>%s<?php }' % self.side
		output += 'if($i[0])require_once($sixtus."page-bottom.php");?>'

		with open(filename, 'w') as f: print('%s' % output, file=f)
