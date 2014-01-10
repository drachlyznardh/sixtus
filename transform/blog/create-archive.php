<?php

	require_once('utils.php');

	# Load map
	require_once($argv[2]);

	$year = split('/', $argv[1]);
	$year = $year[count($year) - 2];
	list($prev, $next) = scan_for_years(array_keys($blog_map), $year);
	$limit = count($blog_map);
	$keys = array_keys($blog_map);

	$to_file[] = sprintf("title#%s#%s\n",
		'Archivio', 'Tutte le notizie di sempre');
	$to_file[] = sprintf("start#page\n");
	
	$to_file[] = sprintf("\ttitle#Anno %s\n", $keys[0]);
	$to_file[] = dump_that_year ($keys[0], $blog_map[$keys[0]]);
	for ($i = 1; $i < $limit; $i++)
	{
		$to_file[] = sprintf("\tsec#br\n");
		$to_file[] = sprintf("\ttitle#Anno %s\n", $keys[$i]);
		$to_file[] = dump_that_year ($keys[$i], $blog_map[$keys[$i]]);
	}

	$to_file[] = sprintf("stop#page\n");
	$to_file[] = sprintf("start#side\n");
	foreach(array_keys($blog_map) as $year)
		$to_file[] = sprintf("\ttitle#Anno %s\n", $year);
	$to_file[] = sprintf("stop#side\n");

	file_put_contents($argv[1], $to_file);
	die();

?>
