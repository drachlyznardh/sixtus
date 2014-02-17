<?php

	function scan_for_months ($directory)
	{
		$result = array();
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

	function scan_for_previous ($target)
	{
		if (!is_file($target)) return array();

		require_once($target);
		return $blog_map;
	}

	function scan_for_equal ($a, $b)
	{
		$limit = count($a);

		if ($limit != count($b)) return false;

		$ak = array_keys($a);
		$bk = array_keys($b);
		for ($i = 0; $i < $limit; $i++)
		{
			if ($ak[$i] != $bk[$i]) return false;

			$k = $ak[$i];
			$ljmjt = count($a[$k]);
			if ($ljmjt != count($b[$k])) return false;

			for ($j = 0; $j < $ljmjt; $j++)
				if ($a[$k][$j] != $b[$k][$j]) return false;
		}

		return true;
	}

	$result = scan_for_years ($argv[2]);
	$previous = scan_for_previous ($argv[1]);

	foreach (array_keys($result) as $year)
		foreach ($result[$year] as $month)
			$series[] = sprintf('%s/%s', $year, $month);
	
	$limit = count($series);
	$prev = $argv[2].$series[0].'.pag';
	for ($i = 1; $i < $limit; $i++)
	{
		$curr = $argv[2].$series[$i].'.pag';
		printf("%s: %s\n", $prev, $curr);
		printf("%s: %s\n", $curr, $prev);
		$prev = $curr;
	}

	if (scan_for_equal($result, $previous)) exit(0);

	$to_file[] = sprintf("%s%s\n\n", '<', '?php');
	foreach (array_keys($result) as $key)
		if (is_array($result[$key]))
			$to_file[] = sprintf("\t%s['%s'] = array('%s');\n",
				'$blog_map', $key, implode('\', \'', $result[$key]));
	$to_file[] = sprintf("\n%s%s\n", '?', '>');

	file_put_contents($argv[1], $to_file);
	exit(0);

?>
