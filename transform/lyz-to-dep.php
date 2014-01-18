<?php

	require_once('utils.php');

	$deps = array();
	$rows = make_lines_from_file($argv[1]);

	foreach ($rows as $_)
		if (preg_match('/include#/', $_))
		{
			$request = split('#', $_);
			$include = make_include_filename ($argv[2], $request[1]);
			$deps[] = $include;
		}

	file_put_contents($argv[4], sprintf('%s: %s', $argv[3], implode(' ', $deps)));
	die();
?>
