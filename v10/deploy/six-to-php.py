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
			self.parse_line(line)

		return self

	def parse_line (self, line):

		if '#' not in line:
			self.content += line;

		token = line.strip().split('#')
		command = token[0]

		if command == 'title':
			self.meta['title'] = token[1]
		elif command == 'subtitle':
			self.meta['subtitle'] = token[1]
		elif command == 'prev':
			self.meta['prev'] = (token[1], token[2])
		elif command == 'next':
			self.meta['next'] = (token[1], token[2])

	def dump_output (self):

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
