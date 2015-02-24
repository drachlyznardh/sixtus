#!/usr/bin/python
# -*- encoding: utf-8 -*-

from __future__ import print_function
import sys

import mapper
import preprocessor
import splitter

if len(sys.argv) != 7:
	args = ['<pag file>', '<map file>',
		'<page location>', '<page name>',
		'<build dir>', '<touch file>']
	print("Usage: %s %s" % (sys.argv[0], ' '.join(args)), file=sys.stderr)
	sys.exit(1)

pag_local_dir = '%s/' % '/'.join(sys.argv[1].split('/')[:-1])
pp = preprocessor.Preprocessor(pag_local_dir)
pp.parse_file(sys.argv[1])

mp = mapper.Mapper(sys.argv[2], sys.argv[3])

sp = splitter.Splitter()
sp.split_content(pp.content)
sp.output_tab_files(mp.base, sys.argv[4].upper(), sys.argv[5])
sp.output_touch_file(sys.argv[6], pp.origin_files)
