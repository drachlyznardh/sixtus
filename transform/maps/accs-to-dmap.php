<?php

	function load_content($filename)
	{
		require_once($filename);

		if (!isset($map)) die("\$Map is not defined.\n");

		return $map;
	}

	function dump_content_help($prefix, $key, $map)
	{
		if ($key) $prefix .= ucwords($key).'/';	
		if (is_array($map)) foreach (array_keys($map) as $_)
			if ($map[$_]) $output[] = dump_content_help($prefix, $_, $map[$_]);
			else $output[] = sprintf("\t#%s['%s'] = '%s';\n", '$direct', $prefix, $map[$_]);
		else $output[] = sprintf("\t%s['%s'] = '%s';\n", '$direct', $prefix, $map);

		return implode($output);
	}

	function dump_content($map)
	{
		foreach(array_keys($map) as $key)
			$output[] = dump_content_help(ucwords($key).'/', false, $map[$key]);
		
		if (isset($output)) return implode($output);
		return sprintf("\t%s = array();\n", '$direct');
	}

	$data = load_content($argv[1]);
	ksort($data);

	$to_file[] = sprintf("%s%s\n\n", '<', '?php');
	$to_file[] = dump_content($data);
	$to_file[] = sprintf("\n%s%s\n", '?', '>');

	file_put_contents($argv[2], $to_file);
	die();

?>
