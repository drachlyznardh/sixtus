#!/usr/bin/python
# encoding: utf-8

from __future__ import print_function

from runtime import Runtime
from resources import Resources
from blog import Blog
from pages import Pages

print('Siχtus 0.10')
Runtime().build()
Resources().build()
Blog().build()
Pages().build()
print('Siχtus 0.10, done')
