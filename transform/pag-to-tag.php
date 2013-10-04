<?php

	require_once('utils.php');

	$taglist = array();
	$rows = make_lines_from_file($argv[1]);
	$base = dirname($argv[1]);

	foreach ($rows as $_)
	{
		if (preg_match('/tag#/', $_))
		{
			$result = split('#', $_);
			print_r($result);
			array_shift($result);
			print_r($result);
			foreach ($result as $r) $taglist[$r] = true;
		}
	}

	print_r($taglist);

?>
