#!/bin/sed -rf
s/\\chapter\{(.*)\}/<h2>\1<\/h2>/
s/^$/<\/p><p>/
s/\\first\{(.*)\}/\1\n<\/p><p>\n/

s/\\begin\{verse\}/<\/p>\n<div class="inside"><p>/
s/\\end\{verse\}/<\/p><\/div><p>\n/
s/\\\\/<\/p><p>/

s/\\lilpause/\n<\/p><\/div><div class="section"><p>\n/
s/\\bigpause/\n<\/p><\/div><div class="section"><p>...<\/p><\/div><div class="section"><p>\n/

s/\\corvino\\/Corvino/
s/\\camelia\\/Camelia/
s/\\battesimo\\/Battesimo/
s/\\smeraldino\\/Smeraldino/
s/\\torto\\/Torto/
s/\\fisthanlarunai\\/Fisthanlarunai/
