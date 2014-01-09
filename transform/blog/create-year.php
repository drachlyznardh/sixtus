<?php

	require_once('utils.php');

	function scan_for_years ($keys, $current)
	{
		$limit = count($keys);
		$result = array(false, false);

		for ($i = 0; $i < $limit; $i++)
			if ($keys[$i] == $current)
			{
				$prev = $i - 1;
				$next = $i + 1;
				if (isset($keys[$prev])) $result[0] = $keys[$prev];
				if (isset($keys[$next])) $result[1] = $keys[$next];
				
				break;
			}

		return $result;
	}

	# Load map
	require_once($argv[2]);

	$year = split('/', $argv[1]);
	$year = $year[count($year) - 2];
	list($prev, $next) = scan_for_years(array_keys($blog_map), $year);

	$to_file[] = sprintf("title#Notizie %s#Tutte le notizie del %s\n", $year, $year);
	$to_file[] = sprintf("start#page\n");
	$to_file[] = sprintf("stop#page\n");
	$to_file[] = sprintf("start#side\n");
	$to_file[] = sprintf("stop#side\n");

	file_put_contents($argv[1], $to_file);
	die();

?>
