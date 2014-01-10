<?php

	require_once('utils.php');

	# Load map
	require_once($argv[2]);

	$year = split('/', $argv[1]);
	$year = $year[count($year) - 2];
	list($prev, $next) = scan_for_years(array_keys($blog_map), $year);

	$to_file[] = sprintf("title#%s#%s\n",
		'Archivio', 'Tutte le notizie di sempre');
	$to_file[] = sprintf("start#page\n");
	foreach(array_keys($blog_map) as $year)
		$to_file[] = sprintf("\ttitle#Anno %s\n", $year);
	$to_file[] = sprintf("stop#page\n");
	$to_file[] = sprintf("start#side\n");
	foreach(array_keys($blog_map) as $year)
		$to_file[] = sprintf("\ttitle#Anno %s\n", $year);
	$to_file[] = sprintf("stop#side\n");

	file_put_contents($argv[1], $to_file);
	die();

?>
