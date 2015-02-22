#!/bin/bash

if [ $# -ne 8 ]; then
	files="<php.in neck file> <php.in left-side file> <php.in knee file> <php file>"
	params="@SITE_COPYRIGHT_YEARS@ @SITE_COPYRIGHT OWNER@ @SITE_PAGE_PREV@ @SITE_PAGE_NEXT@"
	echo "Usage: $0 $files $params"
	exit 1
fi

cat $1 | sed -e "s/\@SITE_COPYRIGHT_YEARS\@/${5}/" \
	-e "s/\@SITE_COPYRIGHT_OWNER\@/${6}/" > $4
cat $2 >> $4
cat $3 | sed -e "s/\@SITE_PAGE_PREV\@/${7}/" \
	-e "s/\@SITE_PAGE_NEXT\@/${8}/" >> $4
