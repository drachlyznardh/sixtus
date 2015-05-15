# -*- encoding: utf-8 -*-

from __future__ import print_function

from .util import assert_dir

class Post:

	def __init__ (self, title=False, category=[]):

		self.title = title
		self.category = category
		self.content = ''

	def append_content (self, text):

		if len(self.content):
			self.content += ('\n%s' % text)
		else: self.content = text

	def display_category (self):

		size = len(self.category)

		if size == 0: return ''

		if size == 1:
			return '/ %s\n' % self.category[0].capitalize()

		all_but_last = ', '.join(w.capitalize() for w in self.category[0:-1])
		last = self.category[-1].capitalize()

		return '/ %s &amp; %s\n' % (all_but_last, last)

class Poster:

	def __init__ (self, home, this_page, prev_page, next_page):

		self.home = home

		self.this_page = this_page
		self.prev_page = prev_page
		self.next_page = next_page

		self.post = {}

	def apply_values (self, fmt):

		result = fmt.replace('@THIS_YEAR@', self.this_page[0])
		result = result.replace('@THIS_MONTH@', self.this_page[1])
		return result.replace('@THIS_MONTH_NAME@', self.this_page[2])

	def parse_conf (self, conf):

		month_conf = conf['lang']['blog']['month']
		self.title = self.apply_values(month_conf['title'])
		self.subtitle = self.apply_values(month_conf['subtitle'])

	def store_post (self, day, post):

		if post.title == False: return
		if day not in self.post: self.post[day] = []
		self.post[day].append(post)

	def parse_file (self, filename):

		day = False
		post = Post()

		with open(filename) as f:
			for i in f:
				line = i.strip()

				if len(line) == 0:
					post.append_content(line)
					continue

				if line[0] == '#':
					post.append_content('')
					continue

				if line.startswith('post|'):

					self.store_post(day, post)

					token = line.split('|')
					day = token[1]
					post = Post(token[2], token[3:])
					continue

				post.append_content(line)

		self.store_post(day, post)

	def output_pag_file (self, filename):

		output = 'title|%s\n' % self.title
		output += 'subtitle|%s\n' % self.subtitle

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
			progress = 0
			for post in post_list:

				if many: output += 'br|\n'
				else: many = True

				date = '%s/%s/%s' % (self.this_page[0], self.this_page[1], day)
				ref = '%s-%d' % (day, progress)

				output += 'id|%s\n' % ref
				output += 'p|link||%s|%s\n' % (date, ref)
				output += post.display_category()
				output += 'title|%s\n' % post.title
				output += '%s\n' % post.content

				progress += 1

		assert_dir(filename)
		with open(filename, 'w') as f:
			print(output, file=f)

	def output_list_file (self, filename):

		output = 'id|%s-%s\n' % (self.this_page[0], self.this_page[1])
		destination = '%s/%s/%s/' % (self.home, self.this_page[0], self.this_page[1])
		output += 'stitle|link|%s|%s@ %s\n' % (destination, self.this_page[2], self.this_page[0])

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

		assert_dir(filename)
		with open(filename, 'w') as f:
			print(output, file=f)

