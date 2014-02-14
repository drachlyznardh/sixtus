<?php

	var_dump($argv);

	$srcfile = $argv[1];
	$row = file($srcfile);
	
	foreach (array_keys($row) as $lineno)
	{
		$line = trim($row[$lineno]);

		printf("%10s %04d: [%s]\n", $srcfile, $lineno, $line);
	}

?>
