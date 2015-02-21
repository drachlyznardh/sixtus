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

print
