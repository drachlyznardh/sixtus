<?php

	require_once('utils.php');

	$day     = 0;
	$month   = 0;
	$year    = 0;
	$current = array();

	$in_rows = make_lines_from_file($argv[1]);

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

	print_r($out_rows);

	printf("\n\n");

	foreach (array_keys($out_rows) as $day)
	{
		$posts = $out_rows[$day];
		$count = count($posts);
		$multipost = $count > 1;
		
		foreach ($posts as $post)
		{
			if ($multipost) $tab = sprintf("%02d%c", $day, 96+$count);
			else $tab = sprintf("%02d", $day);

			printf("tab#%s\n", $tab);
			$count--;

			printf("\tp#link#Blog/%s/%s/#<em>@%02d/%s/%s@</em>#%s\n",
				$year, $month, $day, $month, $year, $tab);
			printf("\ttitle#%s\n", $title);

			foreach ($post['content'] as $line) printf("%s\n", $line);
		}
	}

?>
