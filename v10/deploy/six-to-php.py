#!/usr/bin/python
# -*- encoding: utf-8 -*-

import sys
import re

print
for i in sys.argv: print("[%s]" % i)
print

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

	continue

	if re.match(r'^title#(.*)', line):
		title = re.sub(r'^title#(.*)', r'\1', line)
		print("Title (%s)" % title)
	if re.match(r'^subtitle#(.*)', line):
		subtitle = re.sub(r'^subtitle#(.*)', r'\1', line)
		print("Subtitle (%s)" % subtitle)
	if re.match(r'^prev#(.*)', line):
		prev = line.split('#')
		prev.pop(0)
		print("Prev (%s)" % prev)
	if re.match(r'^next#(.*)', line):
		next = line.split('#')
		next.pop(0)
		print("Next (%s)" % next)

print
