<?php

	require_once('utils.php');

	echo ("-- map-to-rmap.php --\n");
	echo ("\nArgv");
	print_r($argv);

	$rmap = make_page_reverse_map ($argv[1]);
	echo ("\nRMap");
	print_r($rmap);

	$to_file = '<?php';
	foreach (array_keys($rmap) as $_)
		$to_file .= "\n\t\$rmap['$_'] = '$rmap[$_]';";
	$to_file .= "\n".'?>';

	echo ($to_file);
	file_put_contents($argv[2], $to_file);

	return;

?>
