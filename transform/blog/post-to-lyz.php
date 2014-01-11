<?php

	require_once('utils.php');

	$day     = 0;
	$month   = 0;
	$year    = 0;
	$current = array();

	$in_rows = file($argv[1], FILE_IGNORE_NEW_LINES);

	foreach ($in_rows as $_)
	{
		if (preg_match('/blog#/', $_))
		{
			list($_, $year, $month) = split('#', $_);
		}
		else if (preg_match('/post#/', $_))
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

	function prev_year($month, $year)
	{
		if ($month == 1) return $year - 1;
		return $year;
	}

	function next_year($month, $year)
	{
		if ($month == 12) return $year + 1;
		return $year;
	}

	ksort($out_rows);
	$out_rows = array_reverse($out_rows, true);
	$output[] = sprintf("title#%s#%s %s\n", $year, name_that_month($month), $year);
	$output[] = sprintf("prev#Blog/%s/%s/#%s@ %s\n",
		$year, $month, name_that_month($month - 1), prev_year($month, $year));
	$output[] = sprintf("next#Blog/%s/%s/#%s@ %s\n",
		$year, $month, name_that_month($month + 1), next_year($month, $year));
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
			$output[] = sprintf("\ttitle#%s\n", $title);

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
