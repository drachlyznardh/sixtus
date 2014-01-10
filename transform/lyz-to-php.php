<?php

	require_once('sys/section.php');
	require_once('sys/tab.php');
	require_once('sys/parser.php');

	print_r($argv);

	$p = new Parser($argv[1]);
	$p->parse($argv[2]);
	$p->deploy($argv[3], $argv[4], str_replace('/', '_', $argv[5]));

?>
