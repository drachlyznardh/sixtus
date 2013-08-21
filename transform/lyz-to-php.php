<?php

	require_once('sys/section.php');
	require_once('sys/tab.php');
	require_once('sys/parser.php');

	$p = new Parser($argv[1]);
	$p->parse($argv[2]);
	$p->deploy();

?>
