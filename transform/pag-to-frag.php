<?php

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

	$statename = array('meta', 'body', 'ghost', 'side');
	$state = 'meta';
	$current = &$meta;
	$srcfile = $argv[1];
	$row = file($srcfile);
	
	foreach (array_keys($row) as $lineno)
	{
		$line = trim($row[$lineno]);

		if (preg_match('/#/', $line))
		{
			$token = split('#', $line);

			switch ($token[0]) {
				case 'stop':
					break;
				case 'start':
					$state = $token[1];
					$current = &$$token[1];
					break;
				case 'tab':
					${$state}[$token[1]] = array();
					$current = &${$state}[$token[1]];
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
	foreach(array_keys($ghost) as $_)
		output_on_file('ghost-'.$_, array($srcfile), $ghost[$_]);
	output_on_file('side', array($srcfile), $side);

?>
