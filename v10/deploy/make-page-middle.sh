#!/bin/bash

if [ $# -ne 11 ]; then
	files="<php.in neck file> <php.in left-side file> <php.in knee file> <php file>"
	params="@SITE_COPYRIGHT_YEARS@ @SITE_COPYRIGHT OWNER@"
	params+=" @SITE_TAB_NEXT_BEFORE@ @SITE_TAB_NEXT_LINK@ @SITE_TAB_NEXT_AFTER@"
	params+=" @SITE_PAGE_PREV@ @SITE_PAGE_NEXT@"
	echo "Usage: $0 $files $params"
	exit 1
fi

cat $1 | sed -e "s/\@SITE_COPYRIGHT_YEARS\@/${5}/" \
	-e "s/\@SITE_COPYRIGHT_OWNER\@/${6}/" \
	-e "s/\@SITE_TAB_NEXT_BEFORE\@/${7}/" \
	-e "s/\@SITE_TAB_NEXT_LINK\@/${8}/" \
	-e "s/\@SITE_TAB_NEXT_AFTER\@/${9}/" > $4
cat $2 >> $4
cat $3 | sed -e "s/\@SITE_PAGE_PREV\@/${10}/" \
	-e "s/\@SITE_PAGE_NEXT\@/${11}/" >> $4
