<?php

	require_once('utils.php');

	function dump_that_year ($year, $months)
	{
		$format = "link#Blog/%s/%s#%s";
		$slash = "\n\t\t/\n\t\t";
		
		for ($i = 0; $i < 4; $i++)
		{
			$result[] = "\tc#";

			$month = sprintf('%02d', $i * 3 + 1);
			if (array_search($month, $months) !== false)
				$result[] = sprintf($format,
					$year, $month, name_that_month($month));
			else $result[] = sprintf("%s", name_that_month($month));

			$result[] = $slash;

			$month = sprintf('%02d', $i * 3 + 2);
			if (array_search($month, $months) !== false)
				$result[] = sprintf($format,
					$year, $month, name_that_month($month));
			else $result[] = sprintf("%s", name_that_month($month));
		
			$result[] = $slash;

			$month = sprintf('%02d', $i * 3 + 3);
			if (array_search($month, $months) !== false)
				$result[] = sprintf($format,
					$year, $month, name_that_month($month));
			else $result[] = sprintf("%s", name_that_month($month));

			$result[] = "\n";
		}

		return implode($result);
	}

	print_r($argv);
	exit(1);

	require_once('utils.php');

	# Load map
	require_once($argv[2]);

	$limit = count($blog_map);
	$key = array_keys($blog_map);

	$to_file[] = sprintf("title#%s#%s\n",
		'Archivio', 'Tutte le notizie di sempre');
	$to_file[] = sprintf("start#page\n");
	
	### body
	for ($i = 0; $i < $limit; $i++)
	{
		if ($i) $to_file[] = sprintf("\tsec#\n");
		$to_file[] = sprintf("\tid#%s\n", $key[$i]);
		$to_file[] = sprintf("\ttitle#link#Blog/%s/#%s\n", $key[$i], $key[$i]);
		$to_file[] = dump_that_year ($key[$i], $blog_map[$key[$i]]);
	}
	### body

	$to_file[] = sprintf("stop#page\n");
	$to_file[] = sprintf("start#side\n");

	### side
	$to_file[] = sprintf("\ttitle@right#Salta all'anno\n");
	$to_file[] = sprintf("\tp#tid#%s##%s\n", $key[0], $key[0]);
	for ($i = 1; $i < $limit; $i++)
		$to_file[] = sprintf("\t/\n\ttid#%s##%s\n", $key[$i], $key[$i]);
	### side
	
	$to_file[] = sprintf("stop#side\n");

	file_put_contents($argv[1], $to_file);
	die();

?>
