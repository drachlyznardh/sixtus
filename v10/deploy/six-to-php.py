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

	if re.match(r'^title#(.*)', line):
		title = re.sub(r'^title#(.*)', r'\1', line)
		print("Title (%s)" % title)

print
