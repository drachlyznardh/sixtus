#!/usr/bin/python
# -*- encoding: utf-8 -*-

from __future__ import print_function
import sys

if len(sys.argv) != 3:
	params = ['<output file>', '<rel file>']
	print('Usage: %s %s' % (sys.argv[0], ' '.join(params)))
	sys.exit(1)

pag_file = sys.argv[1]

with open(sys.argv[2], 'r') as f:
	target = eval(f.read())

with open(pag_file, 'w') as f: print('jump|Blog/%s/' % sorted(target)[-1], file=f)
