from distutils.core import setup
__version__ = open('VERSION').read().strip()
setup(
	name='sixtus',
	version=__version__,
	url='https://github.com/drachlyznardh/sixtus',
	author='Ivan Simonini',
	author_email='drachlyznardh@gmail.com',
	package_dir={'sixtus':''},
	packages=['sixtus'],
	package_data={'sixtus':['data/*', 'README.md', 'CHANGELOG', 'VERSION']}
)
