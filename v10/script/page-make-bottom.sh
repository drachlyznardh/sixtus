#!/bin/bash

if [ $# -ne 2 ]; then
	echo "Usage: $0 <php.in file> <php file>"
	exit 1
fi

cat $1 > $2
