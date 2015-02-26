#!/usr/bin/python
# -*- encoding: utf-8 -*-

from __future__ import print_function
import sys
from converter import Converter

if len(sys.argv) < 4:
	print ("Usage: %s <six file> <location> <php file>", file=sys.stderr)
	sys.exit(1)

Converter().parse_file(sys.argv[1], sys.argv[2]).dump_output(sys.argv[3]);
