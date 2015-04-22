# encoding: utf-8

from __future__ import print_function

from .splitter import Splitter

def from_Six_to_six_files (Six_file, base, destination):

	sp = Splitter()
	sp.parse_file(Six_file)
	sp.output_files(base, destination)

