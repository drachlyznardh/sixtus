<?php
	print_r($argv);
	include($argv[1]);
	include($argv[2]);
	print_r($tag);
	$key = array_keys($tag)[0];
	$update = count($tag[$key]);
	echo ("Updated count of [$key] is [$update]");
	$total_values[$key] = $update;

	$to_file = '<'.'?php';
	foreach(array_keys($total_values) as $_)
		$to_file .= "\n\t\$total_values['$_'] = $total_values[$_];";
	$to_file .= "\n".'?'.'>';
	echo ($to_file);
	file_put_contents($argv[2], $to_file);
	die();
?>
