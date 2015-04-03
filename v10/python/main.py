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
	print(' -h --help : show this help')

def sixtus_version ():
	print('Siχtus 0.10')

def sixtus_read_args ():

	debug = {}
	short_opt = 'hvxwn'
	long_opt = ['help', 'verbose', 'version',
		'explain', 'why', 'not', 'why-not']

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

	print(debug)

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
