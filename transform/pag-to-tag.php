<?php

	require_once('utils.php');
	require_once('runtime-utils.php');

	function put_array_on_file ($filename, $array_name, $array_data)
	{
		$array_name = ucwords($array_name);
		$to_file = '<?php';
		foreach(array_keys($array_data) as $key)
		{
			$to_file .= "\n\t";
			#print_r($array_data[$key]);
			$to_file .= "\$tag['$array_name'] = '".array_keys($array_data[$key])[0]."';";
		}
		$to_file .= "\n".'?>';

		if (!file_exists($filename)) mkdir(dirname($filename), 0777, true);
		file_put_contents($filename, $to_file);
	}

	function get_array_from_tagfile ($filename)
	{
		if (file_exists($filename))
		{
			include ($filename);
			return $tag;
		}

		return array();
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
			if (file_exists($includename))
				$tag = get_array_from_tagfile($includename);

			$tag[$key] = $canonical_name;
			put_array_on_file($includename, $key, $tag);
			//echo ("\nWrote on [$includename]\n");
		}
		//echo ("Done.\n");
	}

	function put_tag_into_tagfile ($tagname, $basedir, $pagename, $pagetitle)
	{
		$filename = $basedir.get_filename_from_tag($tagname);
		#echo ("Now adding [$pagename] to tag[$tagname] list in [$filename]\n");
		$formerlist = get_array_from_tagfile($filename);
		$newlist = $formerlist;
		$newlist[$tagname][$pagename] = $pagetitle;

		#echo ("\n[Newlist]\n");
		#print_r($newlist);

		$to_file = '<?php';
		foreach (array_keys($newlist[$tagname]) as $_)
			$to_file .= "\n\t\$tag['".ucwords($tagname)."']['$_'] = '".$newlist[$tagname][$_]."';";
		$to_file .= "\n".'?>';

		#print_r($to_file);
		#echo ("\n\tFilename[$filename], Dir[".dirname($filename)."]\n\n");
		if (!file_exists(dirname($filename))) mkdir(dirname($filename), 0777, true);
		#echo ("\n\n");
		file_put_contents($filename, $to_file);
		
		return count($newlist[$tagname]);
	}

	print_r($argv);
	#return;

	$taglist = array();
	$rows = make_lines_from_file($argv[3]);
	$base = dirname($argv[3]);
	$pagetitle = false;

	foreach ($rows as $_)
	{
		if (preg_match('/tag#/', $_))
		{
			$result = split('#', $_);
			array_shift($result);
			foreach ($result as $r) $taglist[$r] = true;
		} else if (preg_match('/title#/', $_))
		{
			$result = split('#', $_);
			if ($pagetitle == false)
			{
				$pagetitle = $result[1];
				#echo ("\n$pagetitle\n");
				$pagetitle = str_replace('\'', '&apos;', $pagetitle);
				#echo ("\n$pagetitle\n");
			}
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
		$to_file .= '$tag[\''.$canonical_name.'\'][\'page\'][\''.ucwords($_).'\'] = '.$taglist[$_].';';
	}
	
	$to_file .= "\n";
	$to_file .= '?>';

	echo ($to_file);
	file_put_contents($argv[4], $to_file);

	$cloud_file = $argv[6];
	if (file_exists($cloud_file)) include($cloud_file);

	foreach (array_keys($taglist) as $_)
		$total_values[$_] = put_tag_into_tagfile ($_, $argv[2], $canonical_name, $pagetitle);
	
	#print_r($total_values);
	$to_file = '<?php';
	foreach(array_keys($total_values) as $_)
		$to_file .= "\n\t\$total_values['$_'] = $total_values[$_];";
	$to_file .= "\n".'?>';

	#echo ($to_file);
	file_put_contents($cloud_file, $to_file);
?>
