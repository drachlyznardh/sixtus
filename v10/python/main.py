#!/usr/bin/python
# encoding: utf-8

from __future__ import print_function
import sys
import getopt

from runtime import Runtime
from resources import Resources
from blog import Blog
from pages import Pages
from filler import Filler

def sixtus_build ():

	print('Siχtus 0.10')
	Runtime().build()
	Resources().build()
	Blog().build()
	Pages().build()
	Filler().build()
	print('Siχtus 0.10, done')

def sixtus_clean ():
	pass

def sixtus_veryclean ():
	pass

def sixtus_help ():
	print('usage: %s [options] <target…>')
	print(' -h --help          : shows this help')
	print(' -v --verbose       : shows performed operations')
	print('    --version       : shows version number')
	print()
	print(' -f,--conf=<file>   : load configuration from <file>')
	print(' -m,--map=<file>    : load sitemap from <file>')
	print()
	print(' -x --explain       : shows explanation for each operation')
	print(' -w --why           : shows explanation on out-of-date files')
	print(' -n --not --why-not : shows explanation on up-to-date files')

def sixtus_version ():
	print('Siχtus 0.10')

def sixtus_read_args ():

	debug = {}
	map_file = 'map.py'
	conf_file = 'conf.py'

	short_opt = 'hvxwnf:m:'
	long_opt = ['help', 'verbose', 'version',
		'explain', 'why', 'not', 'why-not',
		'map', 'conf']

	try: optlist, args = getopt.gnu_getopt(sys.argv[1:], short_opt, long_opt)
	except getopot.GetoptError as err:
		sixtus_help()
		raise err

	for key, value in optlist:
		if key in ('-h', '--help'):
			sixtus_help()
			return
		elif key in ('-v', '--verbose'):
			debug['loud'] = True
		elif key in ('--version'):
			sixtus_version()
			return
		elif key in ('-x', '--explain'):
			debug['why'] = True
			debug['not'] = True
		elif key in ('-w', '--why'):
			debug['why'] = True
		elif key in ('-n', '--not', '--why-not'):
			debug['not'] = True
		elif key in ('-m', '--map'):
			map_file = value
		elif key in ('-f', '--conf'):
			conf_file = value

	with open(map_file, 'r') as f:
		sitemap = eval(f.read())

	with open(conf_file, 'r') as f:
		conf = eval(f.read())

	bag = (debug, sitemap, conf)

	if len(args) == 0:
		print('No args: building')
		sixtus_build()
		return

	for target in args:
		print('Target %s' % target)
		if target == 'build': sixtus_build()
		elif target == 'clean': sixtus_clean()
		elif target == 'veryclean': sixtus_veryclean()

if __name__ == "__main__":
	sixtus_read_args()
