<?php

	function polish_line ($_)
	{
		$_ = preg_replace('/@SHARP@/', '#', $_);
		$_ = preg_replace('/@AT@/', '&#64;', $_);
		$_ = preg_replace('/\'/', '&apos;', $_);

		return $_;
	}

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

	$filetype = preg_replace($pattern, '$1', $row[0]);
	$i = 1;
	array_shift($row);
	$filenames = array();
	$pattern ='/^[0-9]+ (.+)$/'; 
	while (true)
		if (preg_match($pattern, $row[0]))
		{
			$filenames[] = preg_replace($pattern, '$1', $row[0]);
			array_shift($row);
			$i++;
		}
		else break;
	
	if (!preg_match('/^####$/', $row[0]))
		fail("Missing separator", $argv[1], $i);
	
	array_shift($row);
	$pattern ='/^([0-9]+) ([0-9]+) (.*)$/'; 
	foreach ($filenames as $_)
		printf("\t[%s]\n", $_);

	if ($filetype) require_once('frag/meta-to-php.php');
	else require_once('frag/content-to-php.php');
?>
