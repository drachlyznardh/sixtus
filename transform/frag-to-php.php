<?php

	function fail ($m, $f, $l)
	{
		printf("Error in %s @%04d: %s\n", $f, $l, $m);
		exit(1);
	}

	print_r($argv);

	$row = file($argv[1], FILE_IGNORE_NEW_LINES);

	if (!preg_match('/#### .* .* .*/', $row[0]))
		fail("Wrong format", $argv[1], 1);

	foreach ($row as $_)
		printf("%s\n", $_);

	exit(1);

?>
