<?php

	require_once('utils.php');
	require_once('runtime-utils.php');

	function get_array_from_tagfile ($filename)
	{
		if (file_exists($filename))
		{
			include ($filename);
			return $tag;
		}

		return array();
	}

	function put_tag_into_tagfile ($tagname, $basedir, $pagename, $pagetitle)
	{
		$filename = $basedir.get_filename_from_tag($tagname);
		$formerlist = get_array_from_tagfile($filename);
		$newlist = $formerlist;
		$newlist[$tagname][$pagename] = $pagetitle;

		$to_file = '<?php';
		foreach (array_keys($newlist[$tagname]) as $_)
			$to_file .= "\n\t\$tag['$tagname']['$_'] = '".$newlist[$tagname][$_]."';";
		$to_file .= "\n".'?>';

		if (!file_exists(dirname($filename))) mkdir(dirname($filename), 0777, true);
		file_put_contents($filename, $to_file);
	}

	$taglist = array();
	$rows = make_lines_from_file($argv[3]);
	$base = dirname($argv[3]);
	$pagetitle = false;

	foreach ($rows as $_)
	{
		if (preg_match('/tag#/', $_))
		{
			$result = split('#', strtolower($_));
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

	if (file_exists($argv[5])) include($argv[5]);
	else $rmap = array();
	
	$current_file = str_replace($argv[1], '', $argv[3]);
	$current_page = str_replace('.lyz', '', $current_file);
	$current_page = str_replace('.pag', '', $current_page);
	$current_page = str_replace('/index', '', $current_page);
	#echo ("Current [$current_page]");
	if (isset($rmap[$current_page])) $canonical_name = $rmap[$current_page];
	else {
		$index = strrpos($current_page, '/');
		$current_category = substr($current_page, 0, $index);
		$current_name = substr($current_page, $index + 1);
		$canonical_name = $rmap[$current_category].strtoupper($current_name).'/';
	}
	#echo (", Canonical [$canonical_name]\n");

	$to_file = '<'.'?php';
	$to_file .= "\n\t\$pagetitle='$pagetitle';";
	foreach (array_keys($taglist) as $_)
	{
		$to_file .= "\n\t";
		$to_file .= '$tag[\''.$canonical_name.'\'][\'page\'][\''.ucwords($_).'\'] = '.$taglist[$_].';';
	}
	$to_file .= "\n".'?'.'>';

	#echo ($to_file);
	file_put_contents($argv[4], $to_file);

	foreach (array_keys($taglist) as $_)
		put_tag_into_tagfile ($_, $argv[2], $canonical_name, $pagetitle);
	die();
?>
