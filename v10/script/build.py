#!/usr/bin/python
# encoding: utf-8

def build_Six_file (Six_file):

	pag_file = re.sub(r'^build(.*)\.Six$',r'src\1.pag', Six_file)
	page_base = os.path.dirname(pag_file)
	print('Invoking preprocessor %s %s %s' % (pag_file, page_base, Six_file))

	pp = Preprocessor(page_base)
	pp.parse_file(pag_file)
	assert_dir(Six_file)
	pp.output_file(Six_file)

def build_dep_file (dep_file):

	Six_file = re.sub(r'(.*)\.dep', r'\1.Six', dep_file)
	print('Reading dependencies from %s' % Six_file)
	dep_list = deps.extract(Six_file)
	assert_dir(dep_file)
	with open(dep_file, 'w') as f:
		print('(%s, %s, %s)' % dep_list, file=f)

def get_six_filename (bundle):

	extension = ['page.six', 'jump.six', 'side.six']
	return os.path.join(bundle[1], extension[bundle[0]])

def get_php_filename (bundle):

	extension = ['index.php', 'index.php', 'side.php']
	return os.path.join(bundle[1], extension[bundle[0]])

