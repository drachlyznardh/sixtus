#!/usr/bin/python
# -*- encoding: utf-8 -*-

from __future__ import print_function
import sys

for i in sys.argv: print('[%s]' % i, file=sys.stderr)

with open(sys.argv[2]) as f: sitemap = eval(f.read())

print(sitemap)
