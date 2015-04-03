#!/usr/bin/python
# encoding: utf-8

from __future__ import print_function

from runtime import Runtime
from resources import Resources
from blog import Blog
from pages import Pages
from filler import Filler

print('Siχtus 0.10')
Runtime().build()
Resources().build()
Blog().build()
Pages().build()
Filler().build()
print('Siχtus 0.10, done')
