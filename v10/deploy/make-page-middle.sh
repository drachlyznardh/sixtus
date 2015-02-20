#!/bin/bash

if [ $# -ne 8 ]; then
	echo "Usage: $0 <php.in neck file> <php.in left-side file> <php.in knee file> <php file>
		@SITE_COPYRIGHT_YEARS@ @SITE_COPYRIGHT OWNER@
		@SITE_KEYWORD_PREV@ @SITE_KEYWORD_NEXT@"
	exit 1
fi

cat $1 | sed -e "s/\@SITE_COPYRIGHT_YEARS\@/${5}/" -e "s/\@SITE_COPYRIGHT_OWNER\@/${6}/" > $4
cat $2 >> $4
cat $3 | sed -e "s/\@SITE_KEYWORD_PREV\@/${7}/" -e "s/\@SITE_KEYWORD_NEXT\@/${8}/" >> $4
