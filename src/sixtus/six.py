# encoding: utf-8

from .splitter import Splitter

def from_Six_to_six_files (Six_file, base, destination, naming, debug):

	sp = Splitter(debug)
	sp.parse_file(Six_file)
	sp.output_files(base, destination, naming)

