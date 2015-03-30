#!/usr/bin/python
# encoding: utf-8

from __future__ import print_function
import os

import util
from splitter import Splitter

def from_Six_to_six_files (Six_file, output_dir):

	sp = Splitter()
	sp.parse_file(Six_file)
	sp.output_files(output_dir)

