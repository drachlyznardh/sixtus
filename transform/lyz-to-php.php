<?php

	require_once('sys/section.php');
	require_once('sys/tab.php');
	require_once('sys/parser.php');

	$p = new Parser();
	$p->parse($argv[1]);
	$p->deploy();

?>
