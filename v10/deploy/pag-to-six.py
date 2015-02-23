#!/usr/bin/python
# -*- encoding: utf-8 -*-

from __future__ import print_function
import sys
from splitter import Splitter

if len(sys.argv) != 7:
	args = ['<pag file>', '<map file>',
		'<page location>', '<page name>',
		'<build dir>', '<touch file>']
	print("Usage: %s %s" % (sys.argv[0], ' '.join(args)), file=sys.stderr)
	sys.exit(1)

pag_local_dir = '%s/' % '/'.join(sys.argv[1].split('/')[:-1])
pp = splitter.Preprocessor(pag_local_dir)
pp.parse_file(sys.argv[1])

print('%s' % '\n'.join(pp.content), file=sys.stderr)

Splitter().load_parameters(sys.argv[2:]).split_file(sys.argv[1]).dump_output()
