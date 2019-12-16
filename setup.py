
from setuptools import setup, find_packages
from distutils.command.build_py import build_py

name='sixtus'
version='0.11.9+43'

class BuildPy(build_py):

	def dumpVersionFile(self):
		from os.path import join
		with open(join(self.build_lib, name, 'VERSION'), 'wt') as ofd:
			print('{}'.format(version), file=ofd)

	def run(self):
		super().run()
		if not self.dry_run: self.dumpVersionFile()

setup(
	name=name,
	version=version,
	url='https://github.com/drachlyznardh/sixtus',
	author='Ivan Simonini',
	author_email='drachlyznardh@gmail.com',
	package_dir={'':'src/'},
	packages=find_packages(where='src'),
	package_data={'':['data/*']},
	entry_points={'console_scripts':['sixtus=sixtus.sixtus:main']},
	cmdclass={'build_py':BuildPy}
)

