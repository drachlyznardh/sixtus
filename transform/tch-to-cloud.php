<?php
	include($argv[1]);
	include($argv[2]);
	
	#$key = array_keys($tag)[0];
	#$update = count($tag[$key]);
	#$cloud[$key] = $update;
	$key = basename($argv[1], '.tag');
	$cloud[$key] = count($tag);

	$to_file = '<'.'?php';
	foreach(array_keys($cloud) as $_)
		$to_file .= "\n\t\$cloud['$_'] = $cloud[$_];";
	$to_file .= "\n".'?'.'>';
	
	file_put_contents($argv[2], $to_file);
	die();
?>
