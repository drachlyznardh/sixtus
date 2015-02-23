#!/usr/bin/python
# -*- encoding: utf-8 -*-

from __future__ import print_function
import sys

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

#print('%s' % '\n'.join(pp.content), file=sys.stderr)

class Mapper:

	def __init__ (self, map_file, page_origin):#, build_dir):

		with open(map_file) as file_content:
			site_map = eval(f.read())

		if page_origin not in site_map:
			print('Cannot map [%s] from [%s]!' % (page_origin, map_file), file=sys.stderr)
			sys.exit(1)

		#self.page_destination = '%s%s' % (build_dir, site_map[page_origin])
		self.base = site_map[page_origin]

mp = mapper.Mapper(sys.argv[2], sys.argv[3], sys.argv[5])

sp = splitter.Splitter()#mp.page_destination, sys.argv[4].upper(), sys.argv[6]) #.load_parameters(sys.argv[2:]).split_file(sys.argv[1]).dump_output()
sp.split_content(pp.content)
#sp.dump_output(sys.argv[6])
#sp.output_tab_files(mp.base, sys.argv[4].upper(), sys.argv[5])
#sp.output_touch_file(sys.argv[6], sys.argv[1], pp.required_files)
