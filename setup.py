
from setuptools import setup, find_packages

with open('VERSION', 'r') as ifd:
    version = ifd.read().strip()

setup(
	name='sixtus',
	version=version,
	url='https://github.com/drachlyznardh/sixtus',
	author='Ivan Simonini',
	author_email='drachlyznardh@gmail.com',
	package_dir={'':'src/'},
	packages=find_packages(where='src'),
	package_data={'':['data/*', 'VERSION']},
	entry_points={'console_scripts':['sixtus=sixtus.sixtus:main']}
)
