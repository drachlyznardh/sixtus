<?php

	require_once('utils.php');
	require_once('runtime-utils.php');

	function put_array_on_file ($filename, $array_name, $array_data)
	{
		$to_file = '<?php';
		foreach(array_keys($array_data) as $key)
		{
			$to_file .= "\n\t";
			$to_file .= '$'.$array_name.'[\''.$key.'\'] = '.$array_data[$key].';';
		}
		$to_file .= '?>';

		if (!file_exists($filename)) mkdir(dirname($filename), 0777, true);
		file_put_contents($filename, $to_file);
	}

	function put_tag_into_tag_files ($taglist, $base_dir, $canonical_name)
	{
		//echo ("Now adding tags from [$canonical_name] to TAG_DB\n");
		//print_r($taglist);
		foreach (array_keys($taglist) as $key)
		{
			$filename = get_filename_from_tag($key);
			//echo ("Tag [$key] goes in file [$filename]\n");
			
			$includename = $base_dir.$filename;
			if (file_exists($includename)) include ($includename);

			$tag[$canonical_name] = true;
			put_array_on_file($includename, 'tag', $tag);
			//echo ("\nWrote on [$includename]\n");
		}
		//echo ("Done.\n");
	}

	$taglist = array();
	$rows = make_lines_from_file($argv[3]);
	$base = dirname($argv[3]);

	foreach ($rows as $_)
	{
		if (preg_match('/tag#/', $_))
		{
			$result = split('#', $_);
			array_shift($result);
			foreach ($result as $r) $taglist[$r] = true;
		}
	}

	$page_reverse_map = make_page_reverse_map ($argv[5]);
	$current_file = str_replace($argv[1], '', $argv[3]);
	$current_page = str_replace('.lyz', '', $current_file);
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

	file_put_contents($argv[4], $to_file);

	put_tag_into_tag_files($taglist, $argv[2], $canonical_name);
?>
