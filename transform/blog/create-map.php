<?php

	function scan_for_months ($directory)
	{
		foreach(scandir($directory) as $file)
			if (preg_match('/^(..)\.post$/', $file))
				$result[] = preg_replace('/^(..)\.post$/', '$1', $file);

		return $result;
	}

	function scan_for_years ($directory)
	{
		foreach(scandir($directory) as $file)
			if (preg_match('/^[0-9][0-9][0-9][0-9]$/', $file))
				$result[$file] = scan_for_months("$directory/$file");

		return $result;
	}

	$result = scan_for_years ($argv[2]);
	print_r($argv);
	print_r($result);
	
	$to_file[] = sprintf("%s%s\n\n", '<', '?php');
	foreach (array_keys($result) as $key)
		if (is_array($result[$key])) foreach ($result[$key] as $kkey)
			$to_file[] = sprintf("\t%s['%s']['%s'];\n",
				'$blog_map', $key, $kkey);
	$to_file[] = sprintf("\n%s%s\n", '?', '>');

	file_put_contents($argv[1], $to_file);
	die();

?>
