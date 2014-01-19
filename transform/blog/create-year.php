<?php

	require_once('utils.php');

	# Load map
	require_once($argv[2]);

	$year = split('/', $argv[1]);
	$year = $year[count($year) - 1];
	$year = substr($year, 0, 4);
	list($prev, $next) = scan_for_years(array_keys($blog_map), $year);

	$to_file[] = sprintf("title#Notizie %s#Tutte le notizie del %s\n", $year, $year);
	if ($prev) $to_file[] = sprintf("prev#Blog/%s/#%s\n", $prev, $prev);
	if ($next) $to_file[] = sprintf("next#Blog/%s/#%s\n", $next, $next);
	$to_file[] = sprintf("start#page\n");

	$reverse = array_reverse($blog_map[$year], true);

	### body
	foreach ($reverse as $_)
	{
		$to_file[] = sprintf("\tsec#\n");
		$to_file[] = sprintf("\tid#%s\n", $_);
		$to_file[] = sprintf("\trequire@side#blog/%s/%s\n", $year, $_);
	}
	### body

	$to_file[] = sprintf("stop#page\n");
	$to_file[] = sprintf("start#side\n");

	### side
	$to_file[] = sprintf("\tstitle#%s\n", $year);
	foreach ($reverse as $_)
		$to_file[] = sprintf("\tp#tid#%s##%s\n", name_that_month($_), $_);
	### side

	$to_file[] = sprintf("stop#side\n");

	file_put_contents($argv[1], $to_file);
	die();

?>
