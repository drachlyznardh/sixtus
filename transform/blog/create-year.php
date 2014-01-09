<?php

	require_once($argv[2]);

	$year = split('/', $argv[1]);
	$year = $year[count($year) - 2];

	echo("Year[$year]\n");
	print_r($blog_map);

	die();

?>
