#!/usr/bin/python
# -*- encoding: utf-8 -*-

import sys

print
for i in sys.argv: print("[%s]" % i)
print

f = open(sys.argv[1], 'r')

for i in f:
	line = i.strip()
	print("{%s}" % line)

print
