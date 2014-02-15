<?php

	var_dump($argv);

	$meta  = array();
	$body  = array();
	$ghost = array();
	$side  = array();

	$state = 0;
	$current = &$meta;
	$srcfile = $argv[1];
	$row = file($srcfile);
	
	foreach (array_keys($row) as $lineno)
	{
		$line = trim($row[$lineno]);

		printf("%10s %04d: [%s]\n", $srcfile, $lineno, $line);
		
		if (preg_match('/#/', $line))
		{
			$token = split('#', $line);

			switch ($token[0]) {
				case 'start':
					printf("\tEntering [%s]\n", $token[1]);
					$current = &$$token[1];
					break;
				case 'stop':
					printf("\tLeaving [%s]\n", $token[1]);
					break;
				default:
					$current[] = array($srcfile, $lineno, $line);
			}
		}
		else $current[] = array($srcfile, $lineno, $line);
	}

	print_r($meta);
	print_r($body);
	print_r($side);

?>
