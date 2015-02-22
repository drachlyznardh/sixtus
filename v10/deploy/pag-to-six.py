#!/usr/bin/python
# -*- encoding: utf-8 -*-

from __future__ import print_function
import sys
from splitter import Splitter

if len(sys.argv) != 6:
	print("Usage: %s <pag file> <map file> <location> <pagename> <build dir>", file=sys.stderr)
	sys.exit(1)

Splitter().load_parameters(sys.argv[2:]).split_file(sys.argv[1]).dump_output()
