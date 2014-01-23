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

	function put_tag_into_tagfile ($tagname, $basedir, $data)
	{
		$filename = $basedir.get_filename_from_tag($tagname);
		$formerlist = get_array_from_tagfile($filename);
		$newlist = $formerlist;

		foreach (array_keys($data) as $_)
			foreach ($data[$_] as $__)
				$newlist[$__[0]][$_] = $__[1];

		$to_file = '<'.'?php'."\n";
		foreach(array_keys($newlist) as $_)
			foreach(array_keys($newlist[$_]) as $__)
				$to_file .= "\t\$tag['$_']['$__'] = '".$newlist[$_][$__]."';\n";
		$to_file .= '?'.'>';

		if (!file_exists(dirname($filename))) mkdir(dirname($filename), 0777, true);
		file_put_contents($filename, $to_file);
		return;
		
		foreach (array_keys($pagetitle) as $_)
		{
			if (strcmp($_, 'page') == 0) $key = $pagename;
			else $key = substr($pagename, 0, -1).'§'.$_.'/';
			$newlist[$pagename][$_] = $pagetitle[$_];
		}

		$to_file = '<'.'?php';
		foreach (array_keys($newlist) as $_)
			foreach (array_keys($newlist[$_]) as $__)
				$to_file .= "\n\t\$tag['$_']['$__'] = '".$newlist[$_][$__]."';";
		$to_file .= "\n".'?'.'>';

		if (!file_exists(dirname($filename))) mkdir(dirname($filename), 0777, true);
		file_put_contents($filename, $to_file);
	}

	$taglist = array();
	print_r($argv);
	$rows = file($argv[2], FILE_IGNORE_NEW_LINES);
	$base = dirname($argv[2]);
	$pagetitle = false;
	$environment = 'page';

	foreach ($rows as $_)
	{
		if (preg_match('/tag#/', $_))
		{
			$result = split('#', strtolower($_));
			array_shift($result);
			foreach ($result as $r) $taglist[$environment][$r] = true;
		}
		else if (preg_match('/title#/', $_))
		{
			$result = split('#', $_)[1];
			$result = str_replace('\'', '&apos;', $result);
			if (!isset($pagetitle[$environment]))
				$pagetitle[$environment] = $result;
		}
		else if (preg_match('/stop#/', $_))
			$environment = 'page';
		else if (preg_match('/tab#/', $_))
			$environment = split('#', $_)[1];
	}

	if (file_exists($argv[4])) include($argv[4]);
	else $rmap = array();
	
	$current_file = str_replace($argv[1], '', $argv[3]);
	$current_page = str_replace('.lyz', '', $current_file);
	$current_page = str_replace('.pag', '', $current_page);
	$current_page = str_replace('/index', '', $current_page);

	if (isset($rmap[$current_page])) $canonical_name = $rmap[$current_page];
	else {
		$index = strrpos($current_page, '/');
		$current_category = substr($current_page, 0, $index);
		$current_name = substr($current_page, $index + 1);
		$canonical_name = $reverse[$current_category].mb_strtoupper($current_name, 'UTF-8').'/';
	}

	$to_file = '<'.'?php';
	foreach (array_keys($pagetitle) as $_)
		$to_file .= "\n\t\$pagetitle['$_']='$pagetitle[$_]';";
	foreach (array_keys($taglist) as $_)
		foreach (array_keys($taglist[$_]) as $__)
	{
		$to_file .= "\n\t";
		$to_file .= '$tag[\''.$canonical_name.'\'][\''.$_.'\'][\''.ucwords($__).'\'] = '.$taglist[$_][$__].';';
	}
	$to_file .= "\n".'?'.'>';
	file_put_contents($argv[4], $to_file);

	// Creating the reverse map
	foreach (array_keys($taglist) as $_)
		foreach (array_keys($taglist[$_]) as $__)
			$rtmap[$__][$_][] = array($canonical_name, $pagetitle[$_]);

	if (isset($rtmap))
		foreach (array_keys($rtmap) as $_)
			put_tag_into_tagfile ($_, $argv[2], $rtmap[$_]);

	die();
?>
