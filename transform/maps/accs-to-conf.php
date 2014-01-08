<?php

	function load_content($filename)
	{
		require_once($filename);

		if (!isset($homepage)) die("\$Homepage is not defined.\n");
		if (!isset($style)) die("\$Style is not defined.\n");
		if (!is_array($style)) die("\$Style is not an array.\n");

		$result['homepage'] = $homepage;
		$result['style'] = $style;

		return $result;
	}

	$data = load_content($argv[1]);

	$to_file[] = sprintf("%s%s\n\n", '<', '?php');
	$to_file[] = sprintf("\t%s = '%s';\n",
		'$runtime[\'home\']', $data['homepage']);

	$to_file[] = sprintf("\t%s = array(", '$style');
	for ($i = 0; $i < count($data['style']); $i++)
		if ($i > 0) $to_file[] = sprintf(", '%s'", $data['style'][$i]);
		else $to_file[] = sprintf("'%s'", $data['style'][$i]);
	$to_file[] = sprintf(");\n");
	$to_file[] = sprintf("\n%s%s\n", '?', '>');

	file_put_contents($argv[2], $to_file);
	die();

?>
