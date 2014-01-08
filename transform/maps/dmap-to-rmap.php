<?php

	function load_content($filename)
	{
		require_once($filename);

		if (!isset($direct)) die("\$Direct is not defined.\n");

		return $direct;
	}

	$data = load_content($argv[1]);

	$result = array();
	foreach (array_keys($data) as $key)
		if (!isset($result[$data[$key]]))
			$result[$data[$key]] = $key;
	ksort($result);

	$to_file[] = sprintf("%s%s\n\n", '<', '?php');
	foreach (array_keys($result) as $key)
			$to_file[] = sprintf("\t%s['%s'] = '%s';\n",
				'$reverse', $key, $result[$key]);
	$to_file[] = sprintf("\n%s%s\n", '?', '>');

	file_put_contents($argv[2], $to_file);
	die();

?>
