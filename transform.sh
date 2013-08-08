#!/bin/bash
echo -e "[$1 => ${1/.lyz/.php}]"
php -f /opt/devel/horror/horror.php $1 > ${1/.lyz/.php} || echo "$1 => ${1/.lyz/.php}:  FUCK!"
