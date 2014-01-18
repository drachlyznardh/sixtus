<?php

	require_once('utils.php');

	$deps = array();
	$rows = make_lines_from_file($argv[1]);
	$base = dirname($argv[1]);

	foreach ($rows as $_)
		if (preg_match('/include#/', $_))
		{
			$request = split('#', $_);
			$include = make_include_filename ($base, $request[1]);
			$deps[] = $include;
		}

	file_put_contents($argv[3], sprintf('%s: %s', $argv[2], implode(' ', $deps)));
	die();
?>
