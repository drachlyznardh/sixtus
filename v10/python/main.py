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

def sixtus_build (bag):

	print('Siχtus 0.10')
	Runtime(bag).build()
	Resources(bag).build()
	Blog(bag).build()
	Pages(bag).build()
	Filler(bag).build()
	print('Siχtus 0.10, done')

def sixtus_clean (bag):
	pass

def sixtus_veryclean (bag):
	pass

def sixtus_help ():
	print('usage: %s [options] <target…>')
	print(' -h --help          : shows this help')
	print(' -v --verbose       : shows performed operations')
	print('    --version       : shows version number')
	print()
	print(' -f,--conf=<file>   : load configuration from <file>')
	print(' -m,--map=<file>    : load sitemap from <file>')
	print(' -t,--time=<float>  : use <float> as time delta for date comparison')
	print()
	print(' -x --explain       : shows explanation for each operation')
	print(' -w --why           : shows explanation on out-of-date files')
	print(' -n --not --why-not : shows explanation on up-to-date files')

def sixtus_version ():
	print('Siχtus 0.10')

def sixtus_read_args ():

	debug = {}
	time_delta = 0.5
	map_file = 'map.py'
	conf_file = 'conf.py'

	short_opt = 'hvxwnf:m:t:'
	long_opt = ['help', 'verbose', 'version',
		'explain', 'why', 'not', 'why-not',
		'map', 'conf', 'time']

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
		elif key in ('-t', '--time'):
			time_delta = float(value)

	with open(map_file, 'r') as f:
		sitemap = eval(f.read())

	with open(conf_file, 'r') as f:
		conf = eval(f.read())

	bag = (debug, time_delta, sitemap, conf)

	if len(args) == 0:
		sixtus_build(bag)
		return

	for target in args:
		if target == 'build': sixtus_build(bag)
		elif target == 'clean': sixtus_clean(bag)
		elif target == 'veryclean': sixtus_veryclean(bag)
		else: raise Exception('What target is %s supposed to be?' % target)

if __name__ == "__main__":
	sixtus_read_args()
