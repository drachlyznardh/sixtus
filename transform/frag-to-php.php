<?php

	function fail ($m, $f, $l)
	{
		printf("Error in %s @%04d: %s\n", $f, $l, $m);
		exit(1);
	}

	function check_line_format ($line, $i)
	{
		$pattern ='/^([0-9]+) ([0-9]+) (.*)$/'; 

		if (!preg_match($pattern, $line))
			fail("Wrong format", $argv[1], $i);
	
		$f = preg_replace($pattern, '$1', $line);
		$l = preg_replace($pattern, '$2', $line);
		$s = preg_replace($pattern, '$3', $line);

		return array($f, $l, $s);
	}

	print_r($argv);

	$row = file($argv[1], FILE_IGNORE_NEW_LINES);

	$pattern = '/^#### ([01])$/';
	if (!preg_match($pattern, $row[0]))
		fail("Wrong format", $argv[1], 1);

	foreach ($row as $_)
		printf("%s\n", $_);

	exit(1);

?>
