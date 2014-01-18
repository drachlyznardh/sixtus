<?php

	function make_lines_from_file ($filename)
	{
		return file($filename, FILE_IGNORE_NEW_LINES);
	}

	function make_include_filename ($base, $filename)
	{
		if (is_file($filename)) return $filename;

		$filename = $base.'/'.$filename;
		if (is_file($filename)) return $filename;

		return false;
	}

	function make_page_map ($filename)
	{
		require_once($filename);
		return $map;
	}

	function make_page_reverse_map_help ($result, $key, $value, $prefix)
	{
		if (is_array($value))
			foreach(array_keys($value) as $kkey)
			{
				if ($kkey === 0) $next_prefix = $prefix;
				else $next_prefix = ucwords($prefix).ucwords($kkey).'/';
				
				$result = make_page_reverse_map_help($result, $kkey, $value[$kkey], $next_prefix);
			}
		else if (!isset($result[$value])) $result[$value] = $prefix;
		
		unset($result['']);
		return $result;
	}

	function make_page_reverse_map ($filename)
	{
		$page_map = make_page_map ($filename);
		$rmap = array();

		foreach (array_keys($page_map) as $key)
			$rmap = make_page_reverse_map_help($rmap, $key, $page_map, '');

		return $rmap;
	}

?>
