<?php
	require_once('utils.php');
	require_once('runtime-utils.php');

	$tag = array();
	include($argv[1]);

	if (count($tag) == 0)
	{
		file_put_contents($argv[2], false);
		return;
	}

	$tag_rdep = array();
	$key = array_keys($tag)[0];
	foreach($tag[$key] as $_)
		foreach (array_keys($_) as $__)
			$tag_rdep[] = get_filename_from_tag($__);
	
	$to_file = false;
	foreach ($tag_rdep as $_)
		$to_file .= "$argv[3]$_: $argv[1]\n";

	file_put_contents($argv[2], $to_file);
	die();
?>
