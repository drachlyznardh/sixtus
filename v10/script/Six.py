#!/usr/bin/python
# encoding: utf-8

from __future__ import print_function
import os

import util
from preprocessor import Preprocessor

def from_pag_to_Six_file (pag_file, Six_file, src_file):

	pp = Preprocessor(os.path.dirname(pag_file))
	pp.parse_file(pag_file)
	util.assert_dir(Six_file)
	pp.output_Six_file(Six_file)
	return pp.output_src_file(src_file)

def from_src_file (src_file):
	with open(src_file, 'r') as f:
		return eval(f.read())
