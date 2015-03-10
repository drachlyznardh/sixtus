#!/usr/bin/python
# -*- encoding: utf-8 -*-

from __future__ import print_function
import sys

class Upgrader:

	def __init__ (self):

		self.content = ''
		self.state = True

	def error (self, message):

		print('\nUpgrader: %s @ %d: %s' % (self.filename, self.lineno, message),
			file=sys.stderr)
		sys.exit(1)

	def parse_recursive (self, args):

		if len(args) == 1: return args[0]

		c = args[0]

		if c == 'link': return self.parse_link(args)
		if c == 'tid': return self.parse_tid(args)
		if 'speak' in c: return self.parse_speak(args)

		self.error('Cannot recur on %s' % args)

	def parse_link (self, args):

		size = len(args)

		if size == 3: return '\t%s' % '#'.join(args)

		elif size == 4:
			return '\t%s#%s%s/#%s' % (args[0], args[1], args[3].upper(), args[2])

		elif size == 5:
			return '\t%s#%s%s/#%s#%s' % (args[0], args[1], args[3].upper(), args[2], args[4])

		else: self.error('Too many args for link %s' % args)

	def parse_tid (self, args):

		size = len(args)

		if size > 2 and size < 5: return '\t%s' % '#'.join(args)
		else: self.error('Tid expects 2-3 args %s' % args)

	def parse_speak (self, args):

		author = args[0].split('@')[1]
		return 'speak#%s#%s' % (author, args[1])

	def parse_begin (self, args):

		if len(args) != 2: self.error('Begin expects 2 args %s' % args)

		opt = args[1].split('@')
		env = opt[0]

		if env == 'inside' or env == 'outside':
			if len(opt) == 1: return '\tbegin#%s' % env
			else: self.error('%s expects no options %s' % (env, args))

		if env == 'roman':
			opt[0] = 'ol'
			if len(opt) > 4: self.error('%s expects 0-2 options %s' % (env, args))
			return '\tbegin#%s' % '#'.join(opt)

		if env == 'ul' or env == 'ol':
			if len(opt) > 4: self.error('%s expects 0-2 options %s' % (env, args))
			return '\tbegin#%s' % '#'.join(opt)

		if env == 'mini' or env == 'half':
			if opt[1] == 'left' or opt[1] == 'right':
				return '\tbegin#%s#%s\n' % (env, opt[1])
			else: self.error('Illegal direction %s' % args)

		if env == 'double' or env == 'triple':
			self.error('Environment [%s] is no longer supported. Removing or use mini# or half# instead.' % env)

		self.error('Unknown env %s' % args)

	def parse_line (self, line):

		if '#' not in line:
			return '\t%s' % line

		token = line.split('#')
		if token[0] == '': return line

		if token[0] == 'start':

			if len(token) > 2: self.error('Start expectes 1 arg %s' % args)

			if token[1] == 'meta':
				self.state = True
				return '#'.join(token)

			if token[1] == 'page' or token[1] == 'side':
				self.state = False
				return '#'.join(token)

			self.error('Unknown state %s' % args)

		if self.state: return self.parse_meta(token)
		else: return self.parse_content(token)

	def parse_meta (self, args):

		c = args[0]
		size = len(args)

		if c == 'title':
			if size > 1 and size < 4: return '%s' % '#'.join(args)
			else: self.error('Title expects 1-2 args %s' % args)

		if c == 'short':
			if size == 2: return '#'.join(args)
			self.error('Short title expects 1 arg %s' % args)

		if c == 'subtitle':
			if size == 2: return '%s' % '#'.join(args)
			else: self.error('Subtitle expects 1 arg %s' % args)

		if c == 'prev' or c == 'next':
			if size == 3:
				args[2] = ''.join(args[2].split('@'))
				return '%s' % '#'.join(args)
			else: self.error('Relations expect 2 args %s' % args)

		if 'related' in c:
			self.error('Related# command is no longer supported. Manually add reference within the side section.')

		self.error('Unknown meta command %s' % args)

	def parse_title (self, c, args, option):

		if len(option) == 1: direction = 'left'
		elif option[1] == 'right': direction = 'right'
		elif option[1] == 'center': direction = 'center'
		else: self.error('Unknown direction %s %s %s' % (c, option, args))

		if len(args) > 2: content = self.parse_recursive(args)
		else: content = args[0]

		return '\t%s#%s' % (c, content)

	def parse_content (self, args):

		option = args[0].split('@')
		c = option[0]

		if c == 'start': return line
		if c == 'stop': return ''

		if c == 'tab':
			if len(args) == 2: return '#'.join(args)
			else: self.error('Tab expects 1 arg %s' % args)

		if c == 'id':
			if len(args) == 2: return '\tid#%s' % args[1]
			else: self.error('Id@ expects 1 arg %s' % args)

		if c == 'tid': return self.parse_tid(args)

		if c == 'title' or c == 'stitle':
			return self.parse_title (c, args[1:], option)

		elif c == 'p' or c == 'c' or c == 'r':
			return '\t%s#\n%s' % (c, self.parse_recursive(args[1:]))

		elif c == 'post':
			return line

		elif c == 'link':
			return self.parse_link(args)

		elif c == 'begin':
			return self.parse_begin(args)
		elif c == 'end':
			return '\tend#'

		elif c == 'br': return '\tbr#'

		if c == 'sec':
			if len(option) == 2: return '\tid#%s\n\tbr#' % option[1]
			return '\tbr#'

		elif 'speak' in c:
			return self.parse_speak(args)

		elif c == 'img':
			if len(args) > 3: self.error('img# expects 2-3 args %s' % args)
			return '\t%s' % '#'.join(args)

		elif c == 'clear':
			if len(args) == 2: return '\tclear#%s' % args[1]
			return '\tclear#'

		if c == 'include':
			if len(args) == 2: return '\trequire#%s' % args[1]
			else: self.error('include# expects 1 arg %s' % args)

		if 'require' in c:
			self.error('Require# command is no longer supported. Manually add content instead.')

		else: self.error('Unknown content command %s' % args)

	def parse_file (self, filename):

		self.filename = filename
		self.lineno   = 0

		for line in open(sys.argv[1], 'r').readlines():
			self.lineno += 1
			self.content += ('%s\n' % self.parse_line (line.strip()))
