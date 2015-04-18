# encoding: utf-8

from __future__ import print_function
import sys
import os
import getopt

from runtime import Runtime
from resources import Resources
from blog import Blog
from pages import Pages

import util

def sixtus_build (bag):

	d = bag[1].get('loud', False)
	if d: print('Siχtus 0.10')

	Runtime(bag).build()
	Resources(bag).build()
	Blog(bag).build()
	Pages(bag).build()

	if d: print('Siχtus 0.10, done')

def sixtus_clean (bag):

	d = bag[1].get('loud', False)
	if d: print('Siχtus 0.10, cleaning')

	build_dir = bag[4].get('build')
	blog_build_dir = bag[4].get('blog-out')

	import shutil
	if d: print('Removing build dir %s' % build_dir)
	if os.path.exists(build_dir): shutil.rmtree(build_dir)

	if d: print('Removing build blog dir %s' % blog_build_dir)
	if os.path.exists(blog_build_dir): shutil.rmtree(blog_build_dir)

	if d: print('Siχtus 0.10, cleaning done')

def sixtus_veryclean (bag):

	d = bag[1].get('loud', False)
	if d: print('Siχtus 0.10, cleaning hard')

	Resources(bag).remove()
	Runtime(bag).remove()
	Pages(bag).remove()
	sixtus_clean(bag)

	if d: print('Siχtus 0.10, cleaning hard done')

def sixtus_help ():
	print('usage: %s [options] (build|clean|veryclean|rebuild)*' % sys.argv[0])
	print()
	print(' -h --help          : shows this help')
	print(' -v --verbose       : shows performed operations')
	print(' -q --quiet         : avoids showing performed operations and stats')
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
	__version__ = open(os.path.join(os.path.dirname(__file__),'VERSION')).read().strip()
	print('Siχtus v%s' % __version__)

def digest_location (source):

	if 'pag' not in source:
		raise Exception('Location for pag files was not specified')

	pag_location = source.get('pag')
	if not os.path.exists(pag_location):
		raise Exception('Specified location for pag files %s does not exist!' % pag_location)

	if 'blog' in source:
		if 'blog-in' not in source:
			source['blog-in'] = source.get('blog')
		if 'blog-out' not in source:
			source['blog-out'] = os.path.join(source.get('pag'), source.get('blog'))
		if 'blog-home' not in source:
			source['blog-home'] = util.convert(source.get('blog'))

	if 'list' not in source:
		source['list'] = os.path.join(source.get('build'), 'list')

	if 'Six' not in source:
		source['Six'] = os.path.join(source.get('build'), 'dep')
	if 'src' not in source:
		source['src'] = os.path.join(source.get('build'), 'dep')
	if 'dep' not in source:
		source['dep'] = os.path.join(source.get('build'), 'dep')
	if 'six' not in source:
		source['six'] = os.path.join(source.get('build'), 'six')

	this_dir = os.path.dirname(__file__)
	source['runtime'] = os.path.join(this_dir, 'data')

	return source

def sixtus_read_args ():

	flags = {'stats':True}
	time_delta = 0.5
	force = False

	def_map_file = 'map.py'
	def_conf_file = 'conf.py'

	map_file = def_map_file
	conf_file = def_conf_file

	short_opt = 'hvqxwnBf:m:t:'
	long_opt = ['help', 'verbose', 'quiet', 'version',
		'explain', 'why', 'not', 'why-not',
		'force', 'conf', 'map', 'time']

	try: optlist, args = getopt.gnu_getopt(sys.argv[1:], short_opt, long_opt)
	except getopt.GetoptError as err:
		sixtus_help()
		raise err

	for key, value in optlist:
		if key in ('-h', '--help'):
			sixtus_help()
			return
		elif key in ('-v', '--verbose'):
			flags['loud'] = True
		elif key in ('-q', '--quiet'):
			flags['stats'] = False
			flags['loud'] = False
		elif key in ('--version'):
			sixtus_version()
			return
		elif key in ('-x', '--explain'):
			flags['why'] = True
			flags['not'] = True
		elif key in ('-w', '--why'):
			flags['why'] = True
		elif key in ('-n', '--not', '--why-not'):
			flags['not'] = True
		elif key in ('-B', '--force'):
			force = True
		elif key in ('-m', '--map'):
			map_file = value
		elif key in ('-f', '--conf'):
			conf_file = value
		elif key in ('-t', '--time'):
			time_delta = float(value)

	if os.path.exists(map_file):
		with open(map_file, 'r') as f:
			sitemap = eval(f.read())
	elif map_file != def_map_file:
		raise Exception('Specified map file %s does not exist!' % map_file)
	else: sitemap = {}

	if os.path.exists(conf_file):
		with open(conf_file, 'r') as f:
			conf = eval(f.read())
	elif conf_file != def_conf_file:
		raise Exception('Specified conf file %s does not exist!' % conf_file)
	else: raise Exception('Required conf file %s does not exist!' % conf_file)

	loc = digest_location(conf.get('location'))

	bag = (force, flags, time_delta, sitemap, loc, conf)

	if len(args) == 0:
		sixtus_build(bag)
		return

	calls = []
	for target in args:
		if target == 'build':
			calls.append(sixtus_build)
		elif target == 'clean':
			calls.append(sixtus_clean)
		elif target == 'veryclean':
			calls.append(sixtus_veryclean)
		elif target == 'rebuild':
			calls.append(sixtus_veryclean)
			calls.append(sixtus_build)
		else: raise Exception('What target is %s supposed to be?' % target)

	for call in calls: call(bag)

if __name__ == "__main__":
	sixtus_read_args()
