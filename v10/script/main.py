#!/usr/bin/python
# encoding: utf-8

from __future__ import print_function

from runtime import Runtime
from blog import Blog
from sixtus_pages import Sixtus as Pages

print('Siχtus 0.10')
Runtime().build()
Blog().build()
Pages().build()
print('Siχtus 0.10, done')
