<?php

	require_once('utils.php');

	$rows = make_lines_from_file($argv[1]);

	foreach ($rows as $_)
	{
		printf("%s\n", $_);
	}

?>
