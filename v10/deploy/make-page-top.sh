#!/bin/bash

if [ $# -ne 3 ]; then
	echo "Usage: $0 <php.in file> <php file> @SITE_AUTHOR@"
	exit 1
fi

cat $1 | sed -e "s/\@SITE_AUTHOR\@/${3//&/\\&}/"
