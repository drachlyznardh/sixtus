# -*- encoding: utf-8 -*-

from __future__ import print_function
import re

class Post:
	def __init__ (self):
		self.title = False
		self.category = []
		self.content = ''

	def append_content (self, text):
		if len(self.content):
			self.content += ('\n%s' % text)
		else: self.content = text

	def display_category (self):

		size = len(self.category)

		if size == 0: return ''
		if size == 1: result = '/ %s' % self.category[0].capitalize()
		if size > 1:
			result = '/ %s &amp; %s' % (', '.join(w.capitalize() for w in self.category[0:-1]), self.category[-1].capitalize())

		return '%s\n' % result

class Poster:

	def __init__ (self, home, subtitle, this_page, prev_page, next_page):

		self.home = home
		self.subtitle = subtitle

		self.this_page = this_page
		self.prev_page = prev_page
		self.next_page = next_page

		self.check = re.compile(r'^post\|')

		self.content = ''
		self.post_content = {}
		self.post_title = {}
		self.post = {}
		self.current = False

	def store_content (self):

		if self.current in self.post_content.keys():
			self.post_content[self.current].append(self.content)
		elif self.current:
			self.post_content[self.current] = [self.content]

		self.content = ''

	def append_title (self, number, title):

		if number in self.post_title.keys():
			self.post_title[number].append(title)
		else: self.post_title[number] = [title]

	def append_content (self, text):

		if len(self.content):
			self.content += ('\n%s' % text)
		else: self.content = text

	def store_post (self, day, post):
		if post == None: return
		if day not in self.post: self.post[day] = []
		self.post.get(day).append(post)

	def parse_file (self, filename):

		day = False
		post = None

		with open(filename) as f:
			for i in f:
				line = i.strip()

				if len(line) == 0:
					self.append_content(line)
					continue

				if line[0] == '#':
					self.append_content('')
					continue

				if self.check.match(line):

					token = line.split('|')
					size = len(token)

					self.store_post(day, post)
					post = Post()
					day = token[1]
					post.title = token[2]
					if size > 3: post.category = token[3:]

					self.store_content()
					try: self.current = token[1]
					except: raise Exception('(%s), (%s)' % (line, token))

					if size == 4:
						self.append_content('/ %s' % token[3].capitalize())
					if size > 4:
						self.append_content('/ %s &amp; %s' % (', '.join(w.capitalize() for w in token[3:-1]), token[-1].capitalize()))

					self.append_title(token[1], token[2])
					self.append_content('title|%s' % token[2])
					continue

				self.append_content(line)
				post.append_content(line)

		self.store_content()
		self.store_post(day, post)

	def output_pag_file (self, filename):

		output = 'title|%s %s\n' % (self.this_page[2], self.this_page[0])
		output += 'subtitle|%s\n' % self.subtitle % (self.this_page[2], self.this_page[0])

		if self.prev_page:
			destination = '%s/%s/%s/' % (self.home, self.prev_page[0], self.prev_page[1])
			title = '%s %s' % (self.prev_page[2], self.prev_page[0])
			output += 'prev|%s|%s\n' % (destination, title)
		if self.next_page:
			destination = '%s/%s/%s/' % (self.home, self.next_page[0], self.next_page[1])
			title = '%s %s' % (self.next_page[2], self.next_page[0])
			output += 'next|%s|%s\n' % (destination, title)

		output += 'start|side\n'
		output += '\tstitle@right|%s %s\n' % (self.this_page[2], self.this_page[0])

		for day, post_list in sorted(self.post.items()):
			progress = 0
			for post in post_list:
				if progress:
					output += '\t\t&amp;\n'
				else:
					date = '%s/%s' % (day, self.this_page[1])
					output += '\tp|<code>%s</code> –\n' % date
				output += '\t\tlink||%s|%s-%d\n' % (post.title, day, progress)
				progress += 1

		output += 'start|page\n'
		many = False

		for day, post_list in sorted(self.post.items()):
			if many: output += 'br|\n'
			else: many = True
			progress = 0
			for post in post_list:

				destination = '%s/%s/%s/' % (self.home, self.this_page[0], self.this_page[1])
				date = '%s/%s/%s' % (day, self.this_page[1], self.this_page[0])
				ref = '%s-%d' % (day, progress)

				output += 'id|%s\n' % ref
				output += 'p|link|%s|%s|%s\n' % (destination, date, ref)
				output += post.display_category()
				output += 'title|%s\n' % post.title
				output += '%s\n' % post.content

				progress += 1

		with open(filename, 'w') as f:
			print(output, file=f)

	def output_list_file (self, filename):

		output = 'id|%s-%s\n' % (self.this_page[0], self.this_page[1])
		destination = '%s/%s/%s/' % (self.home, self.this_page[0], self.this_page[1])
		output = 'stitle|link|%s|%s %s\n' % (destination, self.this_page[2], self.this_page[0])

		for day, post_list in sorted(self.post.items()):
			progress = 0
			for post in post_list:
				if progress:
					output += '\t\t&amp;\n'
				else:
					date = '%s/%s' % (day, self.this_page[1])
					output += '\tp|<code>%s</code> –\n' % date
				destination = '%s/%s/%s/' % (self.home, self.this_page[0], self.this_page[1])
				output += '\t\tlink|%s|%s|%s-%d\n' % (destination, post.title, day, progress)
				progress += 1

		with open(filename, 'w') as f:
			print(output, file=f)
