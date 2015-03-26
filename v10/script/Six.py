#!/usr/bin/python
# encoding: utf-8

from __future__ import print_function
import os

import util
from preprocessor import Preprocessor

def from_pag_to_Six_file (pag_file, Six_file):

	pp = Preprocessor(os.path.dirname(pag_file))
	pp.parse_file(pag_file)
	util.assert_dir(Six_file)
	pp.output_file(Six_file)
