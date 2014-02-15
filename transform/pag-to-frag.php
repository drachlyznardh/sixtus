<?php

	var_dump($argv);
	function output_on_file ($target, $srcfile, $content)
	{
		$i = 0;
		printf("#### file %s\n", $target);
		foreach ($srcfile as $_) printf("%d %s\n", $i++, $_);
		printf("####\n");
		foreach($content as $_) printf("%d %04d %s\n", 0, $_[1], $_[2]);
	}

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
					$current[] = array(&$srcfile, $lineno, $line);
			}
		}
		else $current[] = array(&$srcfile, $lineno, $line);
	}

	output_on_file('meta', array($srcfile), $meta);
	foreach(array_keys($body) as $_)
		output_on_file('tab-'.$_, array($srcfile), $body[$_]);
	output_on_file('side', array($srcfile), $side);

?>
