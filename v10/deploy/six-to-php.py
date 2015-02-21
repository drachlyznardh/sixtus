#!/usr/bin/python
# -*- encoding: utf-8 -*-

import sys
import re

class Converter:

	def __init__ (self):

		self.meta = {}
		self.location = ''
		self.state = 'meta'
		self.environment = None
		self.writing = False
		self.p_or_li = True

		self.page = ''
		self.side = ''
		self.content = ''

	def error (self, message):

		print('%s @line %d: %s' % (filename, lineno, message))

	def parse_file (self, filename, location):

		self.location = location
		self.filename = filename
		self.lineno = 0

		f = open(filename, 'r')
		for line in f:
			self.lineno += 1
			self.parse_line(line.strip())

		return self

	def parse_line (self, line):

		print('Parse_Line (%s)' % (line))

		if '#' not in line:
			self.append_content(line);

		token = line.split('#')
		command = token[0]

		if command == 'start':
			self.state_update(token[1])
			return

		if self.state == 'meta':
			self.parse_meta(token[0], token[1:])
			return

		self.parse_content(token[0], token[1:])

	def parse_meta (self, command, args):

		print('Parse_Meta (%s, %s)' % (command, args))

		if command == 'title':
			self.meta['title'] = args[0]
		elif command == 'subtitle':
			self.meta['subtitle'] = args[0]
		elif command == 'prev':
			self.meta['prev'] = (args[0], args[1])
		elif command == 'next':
			self.meta['next'] = (args[0], args[1])

	def parse_content (self, command, args):

		print('Parse_Content (%s, %s)' % (command, args))

		if command == 'title':
			self.stop_writing()
			self.content += ('<h2>%s</h2>' % self.parse_args(args))
		elif command == 'stitle':
			self.stop_writing()
			self.content += ('<h3>%s</h3>' % self.parse_args(args))
		elif command == 'link':
			self.append_content(self.make_link(args))
		elif command == 'p' or command == 'c' or command == 'r':
			self.start_writing(command, self.parse_args(args))

	def parse_args (self, args):

		if len(args) == 1: return args[0]

		if args[0] == 'link':
			return self.make_link(args[1:])
		else: self.error('Parse_Args: not a link! %s' % args)

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
			self.content += (' %s' % text)
		elif self.p_or_li:
			self.content += ('<p>%s' % text)
		else:
			self.content += ('<li>%s' % text)

	def make_link (self, args):

		print('Make_Link (%s)' % args)

		if len(args) == 2: href = args[0]
		else: href = '%s#%s' % (args[0], args[2])

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

	def state_update (self, newstate):

		self.stop_writing()

		if self.state == 'page':
			self.page += self.content
			self.content = ''
		elif self.state == 'side':
			self.side += self.content
			self.content = ''

		self.state = newstate

	def dump_output (self):

		self.state_update('meta')

		output = '<?php $d=array('
		output += ('array("%s"),' % ('","'.join(self.location.split('/'))))
		output += ('"%s","%s",' % (self.meta.get('title','title'), self.meta.get('subtitle','subtitle')))
		try: output += ('array%s' % self.meta['prev'])
		except: output += 'false'
		output += ','
		try: output += ('array%s' % self.meta['next'])
		except: output += 'false'
		output += ');'
		output += '$sixtus=$_SERVER["DOCUMENT_ROOT"]."sixtus/";'
		output += 'require_once($sixtus."page-top.php"); ?>'
		output += '%s' % self.page
		output += '<?php require_once($sixtus."page-middle.php"); ?>'
		output += '%s' % self.side
		output += '<?php require_once($sixtus."page-bottom.php"); ?>'

		print output

print
for i in sys.argv: print("[%s]" % i)
print

if len(sys.argv) < 3:
	print ("Usage: %s <source file> <location>")
	sys.exit(1)

f = open(sys.argv[1], 'r')

for i in f:
	line = i.strip()

	if '#' not in line:
		print("{%s}" % line)
		continue

	token = line.split('#')
	print("%s" % token)

	command = token[0]

	if command == 'title':
		print("<h2>%s</h2>" % token[1:])
	elif command == 'subtitle':
		print("<h3>%s</h3>" % token[1:])

print

Converter().parse_file(sys.argv[1], sys.argv[2]).dump_output();

print
