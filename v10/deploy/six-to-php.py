#!/usr/bin/python
# -*- encoding: utf-8 -*-

import sys
import re

class Converter:

	def __init__ (self):

		self.meta = {}
		self.location = ''
		self.state = 'meta'
		self.environment = ''
		self.context = ''

		self.page = ''
		self.side = ''
		self.content = ''

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
			self.content += line;

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
			self.content += ('<h2>%s</h2>' % args[0])
		elif command == 'stitle':
			self.content += ('<h3>%s</h3>' % args[0])

	def state_update (self, newstate):

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
