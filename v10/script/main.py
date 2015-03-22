#!/usr/bin/python
# encoding: utf-8

from __future__ import print_function
import sys

print('Siχtus 0.10')

import os
import fnmatch

if not os.path.exists('src'):
	print('Path [src] does not exist!', file=sys.stderr)
	sys.exit(1)

print('Siχtus 0.10, done')
sys.exit(0)
