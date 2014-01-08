<?php

	require_once('../utils.php');

	$rmap = make_page_reverse_map ($argv[1]);
	$to_file = '<'.'?php';
	foreach (array_keys($rmap) as $_)
		$to_file .= "\n\t\$rmap['$_'] = '$rmap[$_]';";
	$to_file .= "\n".'?'.'>';
	file_put_contents($argv[2], $to_file);
	die();

?>
