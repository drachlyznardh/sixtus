<?php

	require_once('utils.php');

	$deps = array();
	$rows = make_lines_from_file($argv[1]);
	$base = dirname($argv[1]);

	foreach ($rows as $_)
	{
		if (preg_match('/include#/', $_))
		{
			$request = split('#', $_);
			#$request = split('@', $request[1]);
			$include = make_include_filename ($base, $request[1]);
			printf("[%s] -> (%s)[%s] from [%s]\n", $request[1], $base, $include, $_);
			$deps[] = $include;
		}
	}

	file_put_contents($argv[3], printf('%s: %s', $argv[2], implode(' ', $deps)));
	die();
?>
