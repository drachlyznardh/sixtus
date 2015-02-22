#!/bin/bash

if [ $# -ne 6 ]; then
	files="<php.in file> <php file>"
	params="@SITE_AUTHOR@ @SITE_TAB_PREV_BEFORE@ @SITE_TAB_PREV_LINK@ @SITE_TAB_PREV_AFTER@"
	echo "Usage: $0 $files $params"
	exit 1
fi

cat $1 | sed -e "s/\@SITE_AUTHOR\@/${3//&/\\&}/" \
	-e "s/\@SITE_TAB_PREV_BEFORE\@/${4}/" \
	-e "s/\@SITE_TAB_PREV_LINK\@/${5}/" \
	-e "s/\@SITE_TAB_PREV_AFTER\@/${6}/" > $2
