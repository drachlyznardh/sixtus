<?php

	require_once('utils.php');
	require_once($argv[3]);

	$_ = explode('/', $argv[2]);
	$limit = count($_);
	$year = $_[$limit - 2];
	$month = substr($_[$limit - 1], 0, 2);

	$current = array();
	$in_rows = file($argv[1], FILE_IGNORE_NEW_LINES);

	foreach ($in_rows as $_)
	{
		if (preg_match('/post#/', $_))
		{
			if (count($current) > 0) $out_rows[$day][] = $current;
			list($_, $day, $title) = split('#', $_);
			$current = array();
			$current['title'] = $title;
		}
		else $current['content'][] = $_;
	}

	if (count($current) > 0) $out_rows[$day][] = $current;

	####

	foreach (array_keys($out_rows) as $day)
	{
		$count = count($out_rows[$day]);

		if ($count > 1)
			for ($i = 0; $i < $count; $i++)
				$out_rows[$day][$i]['tab'] = sprintf('%02d%c', $day, 96 + $count - $i);
		else $out_rows[$day][0]['tab'] = sprintf("%02d", $day);
	}

	####

	function last_month_of_prev_year($year, $map)
	{
		$key = array_keys($map);
		$index = array_search($year, $key);

		if (isset($key[$index - 1]))
		{
			$one = $key[$index - 1];
			$two = $map[$one];
			$three = $two[count($two) - 1];
			
			#printf("Prev is %s/%s\n", $three, $one);
			return array($one, $three);
			
		} else return false;
	}

	function first_month_of_next_year($year, $map)
	{
		$key = array_keys($map);
		$index = array_search($year, $key);

		if (isset($key[$index + 1]))
		{
			$one = $key[$index + 1];
			$two = $map[$one][0];

			#printf("Next is %s/%s\n", $two, $one);
			return array($one, $two);
			
		} else return false;
	}

	function scan_for_month ($month, $year, $map)
	{
		$limit = count($map);
		$result[0] = false;
		$result[1] = false;

		$key = array_search($month, $map[$year]);
		if (isset($map[$year][$key - 1]))
		{
			$result[0][] = $year;
			$result[0][] = sprintf('%02d', $map[$year][$key - 1]);
		} else $result[0] = last_month_of_prev_year($year, $map);

		$key = array_search($month, $map[$year]);
		if (isset($map[$year][$key + 1]))
		{
			$result[1][] = $year;
			$result[1][] = sprintf('%02d', $map[$year][$key + 1]);
		} else $result[1] = first_month_of_next_year($year, $map);

		return $result;
	}

	ksort($out_rows);
	$out_rows = array_reverse($out_rows, true);
	list($prev, $next) = scan_for_month($month, $year, $blog_map);
	$output[] = sprintf("title#%s %s#Le notizie di %s\n",
		name_that_month($month), $year, name_that_month($month));
	if ($prev)
		$output[] = sprintf("prev#Blog/%s/%02d/#%s@ %s\n",
			$prev[0], $prev[1], name_that_month($prev[1]), $prev[0]);
	if ($next)
		$output[] = sprintf("next#Blog/%s/%02d/#%s@ %s\n",
			$next[0], $next[1], name_that_month($next[1]), $next[0]);
	$output[] = sprintf("tabs#all_or_one\n");
	$output[] = sprintf("start#page\n");

	foreach (array_keys($out_rows) as $day)
	{
		$posts = $out_rows[$day];
		
		foreach ($posts as $post)
		{
			$output[] = sprintf("tab#%s\n", $post['tab']);
			$output[] = sprintf("\tp#link#Blog/%s/%s/#<em>@%02d/%s/%s@</em>#%s\n",
				$year, $month, $day, $month, $year, $post['tab']);
			$output[] = sprintf("\ttitle#%s\n", $post['title']);

			if (isset($post['content'])) foreach ($post['content'] as $line) $output[] = sprintf("%s\n", $line);
		}
	}

	$output[] = sprintf("stop#page\n");
	$output[] = sprintf("start#side\n");
	$output[] = sprintf("\tstitle#link#Blog/%s/%s/#%s@ %s\n",
		$year, $month, name_that_month($month), $year);
	
	foreach (array_keys($out_rows) as $day)
	{
		$posts = $out_rows[$day];
		$first = true;
		$count = count($posts);

		$output[] = sprintf("\tp#<code>%02d/%s</code> –\n", $day, $month);

		for ($i = 0; $i < $count; $i++)
		{
			$post = $posts[$count - $i - 1];
			
			if ($first) $first = false;
			else $output[] = sprintf("\t\t&amp;\n");
			$output[] = sprintf("\t\tlink#Blog/%s/%s/#%s#%s\n",
				$year, $month, $post['title'], $post['tab']);
		}
	}

	$output[] = sprintf("stop#side\n");
	file_put_contents($argv[2], $output);
?>
