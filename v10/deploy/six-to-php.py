#!/usr/bin/python
# -*- encoding: utf-8 -*-

from __future__ import print_function
import sys
from converter import Converter

if len(sys.argv) < 3:
	print ("Usage: %s <source file> <location>", file=sys.stderr)
	sys.exit(1)

Converter().parse_file(sys.argv[1], sys.argv[2]).dump_output();
