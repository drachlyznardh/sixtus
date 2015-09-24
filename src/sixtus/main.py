# encoding: utf-8

from __future__ import print_function
import sys
import os
import getopt

from .runtime import Runtime
from .resources import Resources
from .blog import Blog
from .pages import Pages
from .tex import Tex

from .util import convert, locate_file

_def_map_file = 'map.py'
_def_conf_file = 'conf.py'

class Bag:
	def __init__ (self, force, flags, time_delta, sitemap, location, conf, version):
		self.force = force
		self.flags = flags
		self.time_delta = time_delta
		self.sitemap = sitemap
		self.location = location
		self.conf = conf
		self.version = version

def sixtus_build (bag):

	d = bag.flags.get('loud', False)
	if d: print('Siχtus v%s -- build' % bag.version)

	Runtime(bag).build()
	if 'res' in bag.location: Resources(bag).build()
	if 'blog' in bag.location: Blog(bag).build()
	Pages(bag).build()

	if d: print('Siχtus v%s -- build done' % bag.version)

def sixtus_clean (bag):

	import shutil

	d = bag.flags.get('loud', False)
	if d: print('Siχtus v%s -- cleaning' % bag.version)


	if 'blog-out' in bag.location:
		blog_build_dir = bag.location['blog-out']
		if d: print('Removing build blog dir %s' % blog_build_dir)
		if os.path.exists(blog_build_dir): shutil.rmtree(blog_build_dir)

	build_dir = bag.location['build']
	if d: print('Removing build dir %s' % build_dir)
	if os.path.exists(build_dir): shutil.rmtree(build_dir)

	if d: print('Siχtus v%s -- cleaning done' % bag.version)

def sixtus_veryclean (bag):

	d = bag.flags.get('loud', False)
	if d: print('Siχtus v%s -- cleaning hard' % bag.version)

	Resources(bag).remove()
	Runtime(bag).remove()
	Pages(bag).remove()
	sixtus_clean(bag)

	if d: print('Siχtus v%s -- cleaning hard done' % bag.version)

def sixtus_rebuild (bag):

	sixtus_veryclean(bag)
	sixtus_build(bag)

def sixtus_texmode (bag, texes):
	print('Hello Teχmode %s' % texes)
	Tex(bag.location['runtime'], bag.conf['author']['name']).parse(texes)

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

	for key, value in source.items():
		source[key] = os.path.expanduser(os.path.expandvars(value))

	pag_location = source['pag']

	if 'blog' in source:
		if 'blog-in' not in source:
			source['blog-in'] = source['blog']
		if 'blog-out' not in source:
			source['blog-out'] = os.path.join(source['pag'], source['blog'])
		if 'blog-home' not in source:
			source['blog-home'] = convert(source['blog'])

	if 'list' not in source:
		source['list'] = os.path.join(source['build'], 'list')

	if 'Six' not in source:
		source['Six'] = os.path.join(source['build'], 'dep')
	if 'src' not in source:
		source['src'] = os.path.join(source['build'], 'dep')
	if 'dep' not in source:
		source['dep'] = os.path.join(source['build'], 'dep')
	if 'six' not in source:
		source['six'] = os.path.join(source['build'], 'six')

	this_dir = os.path.dirname(__file__)
	source['runtime'] = os.path.join(this_dir, 'data')

	return source

def main_read_args ():

	if len(sys.argv) == 1:
		return sixtus_read_args([])
	elif sys.argv[1] in ('tex', 'textus'):
		return textus_read_args(sys.argv[2:])
	elif sys.argv[1] in ('six', 'sixtus'):
		return sixtus_read_args(sys.argv[2:])
	else:
		return sixtus_read_args(sys.argv[1:])

def textus_read_args (args):
	print('This is Textus')
	print(args)

	map_file  = _def_map_file
	conf_file = _def_conf_file

	short_opt = 'hvqf:m:'
	long_opt = ['help', 'verbose', 'quiet', 'version',
		'conf', 'map']

	try: optlist, args = getopt.gnu_getopt(args, short_opt, long_opt)
	except getopt.GetoptError as err:
		sixtus_help()
		raise err

	for key, value in optlist:
		if key in ('-h', '--help'):
			return sixtus_help() # textus_help()

	site_map, site_conf = find_required_files(map_file, conf_file)
	version = find_version()

	Tex(bag.location['runtime'], bag.conf['author']['name']).parse(texes)
	print('Textus out')

def sixtus_read_args (args):

	flags = {'stats':True}
	time_delta = 0.5
	force = False

	map_file  = _def_map_file
	conf_file = _def_conf_file

	short_opt = 'hvqxwnBf:m:t:'
	long_opt = ['help', 'verbose', 'quiet', 'version',
		'explain', 'why', 'not', 'why-not',
		'force', 'conf', 'map', 'time']

	try: optlist, args = getopt.gnu_getopt(args, short_opt, long_opt)
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

	texmode = False
	calls = []
	texes = []
	for target in args:
		if target == 'build':
			calls.append(sixtus_build)
		elif target == 'clean':
			calls.append(sixtus_clean)
		elif target == 'veryclean':
			calls.append(sixtus_veryclean)
		elif target == 'rebuild':
			calls.append(sixtus_rebuild)
		elif target == 'tex':
			texmode = True
		elif texmode:
			texes.append(target)
		else: raise Exception('What target is "%s" supposed to be?' % target)

	map_filename = locate_file(os.getcwd(), map_file)

	if map_filename:
		with open(map_filename, 'r') as f:
			sitemap = eval(f.read())
	elif map_file != def_map_file:
		raise Exception('Specified map file "%s" does not exist!' % map_file)
	else: sitemap = {}

	conf_filename = locate_file(os.getcwd(), conf_file)

	if conf_filename:
		with open(conf_filename, 'r') as f:
			conf = eval(f.read())
	elif conf_file != def_conf_file:
		raise Exception('Specified conf file "%s" does not exist!' % conf_file)
	else: raise Exception('Required conf file "%s" does not exist!' % conf_file)

	loc = digest_location(conf['location'])

	version = open(os.path.join(os.path.dirname(__file__),'VERSION')).read().strip()
	bag = Bag(force, flags, time_delta, sitemap, loc, conf, version)

	if texmode:
		return sixtus_texmode(bag, texes)

	if len(args) == 0:
		sixtus_build(bag)
		return

	for call in calls: call(bag)

if __name__ == "__main__":
	sixtus_read_args()

