# encoding: utf-8

import os

from .util import assert_dir
from .preprocessor import Preprocessor

def from_pag_to_Six_file (pag_file, Six_file, src_file, debug):

	pp = Preprocessor(os.path.dirname(pag_file), debug)
	pp.parse_file(pag_file)
	assert_dir(Six_file)
	pp.output_Six_file(Six_file)
	return pp.output_src_file(src_file)

def from_src_file (src_file):
	with open(src_file, 'r') as f:
		return eval(f.read())

