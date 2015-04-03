#!/usr/bin/python
# encoding: utf-8

from __future__ import print_function
import sys

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

def sixtus_read_args ():

	if len(sys.argv) == 1:
		print('No args: building')
		sixtus_build()
		return

	for target in sys.argv[1:]:
		print('Target %s' % target)
		if target == 'build': sixtus_build()
		elif target == 'clean': sixtus_clean()
		elif target == 'veryclean': sixtus_veryclean()

if __name__ == "__main__":
	sixtus_read_args()
