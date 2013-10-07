<?php

	require_once('utils.php');

	$taglist = array();
	$rows = make_lines_from_file($argv[1]);
	$base = dirname($argv[1]);

	print_r($argv);

	foreach ($rows as $_)
	{
		if (preg_match('/tag#/', $_))
		{
			$result = split('#', $_);
			print_r($result);
			array_shift($result);
			print_r($result);
			foreach ($result as $r) $taglist[$r] = true;
		}
	}

	$page_reverse_map = make_page_reverse_map ($argv[3]);
	echo ("\n[Page Reverse Map]\n");
	print_r($page_reverse_map);
	echo ("[Page Reverse Map]\n\n");

	print_r($taglist);

	$to_file = '<?php';
	
	foreach (array_keys($taglist) as $_)
	{
		$to_file .= "\n\t";
		$to_file .= '$tag[\''.'CANONICAL_NAME'.'\'][\'page\'][\''.$_.'\'] = '.$taglist[$_].';';
	}
	
	$to_file .= "\n";
	$to_file .= '?>';

	file_put_contents($argv[2], $to_file);

?>
