<?php

	require_once('utils.php');

	$deps = array();
	$rows = make_lines_from_file($argv[1]);
	$base = dirname($argv[1]);

	foreach ($rows as $_)
	{
		if (preg_match('/include@static#/', $_))
		{
			$request = split('#', $_);
			$request = split('@', $request[1]);
			$include = make_include_filename ($base, $request[0]);
			#printf("[%s] -> [%s] from [%s]\n", $request[0], $include, $_);
			$deps[] = $include;
		}
	}

	echo $argv[2];
	echo ':';
	foreach ($deps as $_) echo ' '.$_;
	printf("\n");
?>
