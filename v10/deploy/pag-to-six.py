#!/usr/bin/python
# -*- encoding: utf-8 -*-

from __future__ import print_function
import sys
import os

if len(sys.argv) != 6:
	print("Usage: %s <pag file> <map file> <location> <pagename> <build dir>", file=sys.stderr)
	sys.exit(1)

class Splitter:

	def __init__ (self):

		self.debug = False

		self.state = 'meta'

		self.meta    = ''
		self.side    = ''
		self.content = False

		self.first   = False
		self.tabname = None

		self.tabs  = {}
		self.prevs = {}
		self.nexts = {}

with open(sys.argv[1]) as f:
	for i in f:
		
		line = i.strip()
		if debug: print(line)

		if line[0] == '#':
			if debug: print('Line is a comment, skip')
			continue

		if '#' not in line:
			if content: content += ('\n%s' % line)
			else: content = line
			if debug: print('Line is simple content, appending')
			continue

		token = line.split('#')
		command = token[0]

		if command == 'start':
			
			if state == 'meta':
				meta += content
			elif state == 'side':
				side += content
			elif state == 'page':
				tabs[tabname] = content

			content = False
			state = token[1]
			continue

		elif command == 'tab':
			if not first: first = token[1]
			tabs[tabname] = content
			content = False
			nexts[tabname] = token[1]
			prevs[token[1]] = tabname
			tabname = token[1]
			continue

		elif content:
			content += ('\n%s' % line)
		else:
			content = line

if state == 'meta':
	meta += content
elif state == 'side':
	side += content
elif state == 'page':
	tabs[tabname] = content

with open(sys.argv[2]) as f: sitemap = eval(f.read())

pagepath = '%s/%s' % (sitemap[sys.argv[3]], sys.argv[4].upper())
filepath = '%s%s/index.six' % (sys.argv[5], pagepath)

dirpath = os.path.dirname(filepath)
if not os.path.exists(dirpath):
	os.makedirs(dirpath)

filecontent = ("jump#%s/%s/" % (pagepath, first.upper()))
with open(filepath, 'w') as outfile:
	outfile.write(filecontent)

touchlist = []

for name, value in tabs.items():

	if name == None: continue
	
	filepath = '%s%s/%s/index.six' % (sys.argv[5], pagepath, name.upper())
	touchlist.append(filepath)
	
	dirpath = os.path.dirname(filepath)
	if not os.path.exists(dirpath):
		os.makedirs(dirpath)

	varmeta = meta

	if name in prevs.keys() and prevs[name]:
		varmeta += '\ntabprev#/%s/%s/' % (pagepath, prevs[name].upper())

	if name in nexts.keys() and nexts[name]:
		varmeta += '\ntabnext#/%s/%s/' % (pagepath, nexts[name].upper())

	filecontent = ('%s\nstart#side\n%s\nstart#page\n%s' % (varmeta, side, value))
	with open(filepath, 'w') as outfile:
		outfile.write(filecontent)

print('SIX_FILES += %s' % (' '.join(touchlist)))
for i in touchlist:
	print('%s: %s' % (i, sys.argv[1]))
