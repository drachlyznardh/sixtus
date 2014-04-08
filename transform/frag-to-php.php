<?php

	require_once('frag/utils.php');

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
	
	if (preg_match('/^#### (.*)$/', $row[0]))
		$tab_id = preg_replace('/^#### (.*)$/', '$1', $row[0]);
	else if (preg_match('/^####$/', $row[0]))
		$tab_id = false;
	else fail("Missing separator", $argv[1], $i);
	
	array_shift($row);
	if ($filetype) require_once('frag/meta-to-php.php');
	else require_once('frag/content-to-php.php');
?>
