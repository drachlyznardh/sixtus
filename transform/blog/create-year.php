<?php

	require_once('utils.php');

	# Load map
	require_once($argv[2]);

	$year = split('/', $argv[1]);
	$year = $year[count($year) - 2];
	list($prev, $next) = scan_for_years(array_keys($blog_map), $year);

	$to_file[] = sprintf("title#Notizie %s#Tutte le notizie del %s\n", $year, $year);
	if ($prev) $to_file[] = sprintf("prev#Blog/%s/#%s\n", $prev, $prev);
	if ($next) $to_file[] = sprintf("next#Blog/%s/#%s\n", $next, $next);
	$to_file[] = sprintf("start#page\n");
	$to_file[] = sprintf("stop#page\n");
	$to_file[] = sprintf("start#side\n");
	$to_file[] = sprintf("stop#side\n");

	file_put_contents($argv[1], $to_file);
	die();

?>
