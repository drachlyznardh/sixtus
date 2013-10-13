<?php
	include($argv[1]);
	include($argv[2]);

	$value = 0;
	foreach(array_keys($tag) as $_)
		$value += count($tag[$_]);

	$key = basename($argv[1], '.tag');
	$cloud[$key] = $value;

	$to_file = '<'.'?php';
	foreach(array_keys($cloud) as $_)
		$to_file .= "\n\t\$cloud['$_'] = $cloud[$_];";
	$to_file .= "\n".'?'.'>';
	
	file_put_contents($argv[2], $to_file);
	die();
?>
