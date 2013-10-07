<?php

	require_once('utils.php');

	$taglist = array();
	$rows = make_lines_from_file($argv[2]);
	$base = dirname($argv[2]);

	foreach ($rows as $_)
	{
		if (preg_match('/tag#/', $_))
		{
			$result = split('#', $_);
			array_shift($result);
			foreach ($result as $r) $taglist[$r] = true;
		}
	}

	$page_reverse_map = make_page_reverse_map ($argv[4]);
	$current_page = str_replace($argv[1], '', $argv[2]);
	$current_page = str_replace('.lyz', '', $current_page);
	$current_page = str_replace('.pag', '', $current_page);
	$current_page = str_replace('/index', '', $current_page);
	//echo ("Current [$current_page]");
	if (isset($page_reverse_map[$current_page])) $canonical_name = $page_reverse_map[$current_page];
	else {
		$index = strrpos($current_page, '/');
		$current_category = substr($current_page, 0, $index);
		$current_name = substr($current_page, $index + 1);
		$canonical_name = $page_reverse_map[$current_category].strtoupper($current_name).'/';
	}
	//echo (", Canonical [$canonical_name]\n");

	$to_file = '<?php';
	
	foreach (array_keys($taglist) as $_)
	{
		$to_file .= "\n\t";
		$to_file .= '$tag[\''.$canonical_name.'\'][\'page\'][\''.$_.'\'] = '.$taglist[$_].';';
	}
	
	$to_file .= "\n";
	$to_file .= '?>';

	file_put_contents($argv[3], $to_file);

?>
