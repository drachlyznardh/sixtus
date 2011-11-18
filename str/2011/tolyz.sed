#!bin/sed/
s/\<\?\=\$\d\-\>//
s/')\?\>//
s/<\/p><p>//
s/', '/\#/
s/','/\#/
s/('/\#/
s/')?>//
s/');//
s/^.*function mkpage.*$/start\#page/
s/<\?php \} \?>/stop\#page/
