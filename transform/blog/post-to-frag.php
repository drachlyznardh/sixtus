<?php

	require_once('utils.php');
	require_once($argv[3]);

	function scan_for_month ($month, $year, $map)
	{
		$prev = false;
		$next = false;

		foreach (array_keys($map) as $_)
			foreach ($map[$_] as $__)
				$short[] = sprintf('%s/%02d', $_, $__);

		$target = sprintf('%s/%02d', $year, $month);
		$index = array_search($target, $short);

		if (isset($short[$index - 1])) $prev = split('/', $short[$index - 1]);
		if (isset($short[$index + 1])) $next = split('/', $short[$index + 1]);

		return array($prev, $next);
	}

	function dump_meta ($source, $target, $month, $year, $rel, $days)
	{
		$title = sprintf('%s %s', $month, $year);
		$subtitle = sprintf('Le notizie di %s', $month);

		if ($rel[0])
			$prev = sprintf('Blog/%s/%02d/#%s@ %s',
				$rel[0][0], $rel[0][1], name_that_month($rel[0][1]), $rel[0][0]);
		else $prev = false;
		if ($rel[1])
			$next = sprintf('Blog/%s/%02d/#%s@ %s',
				$rel[1][0], $rel[1][1], name_that_month($rel[1][1]), $rel[1][0]);
		else $next = false;
		
		$out[] = sprintf("#### 1");
		$out[] = sprintf("%d %s", 0, $source);
		$out[] = sprintf("####");
		$out[] = sprintf("%d %04d %s#%s", 0, 0, 'title', $title);
		$out[] = sprintf("%d %04d %s#%s", 0, 0, 'short', $title);
		$out[] = sprintf("%d %04d %s#%s", 0, 0, 'subtitle', $subtitle);
		if ($prev) $out[] = sprintf("%d %04d %s#%s", 0, 0, 'prev', $prev);
		if ($next) $out[] = sprintf("%d %04d %s#%s", 0, 0, 'next', $next);
		$out[] = sprintf('%d %04d %s#%s', 0, 0, 'tabs', 'all_or_one');
		foreach (array_keys($days) as $day)
		{
			$count = count($days[$day]);
			if ($count > 1)
				for ($i = 0; $i < $count; $i++)
					$out[] = sprintf('%d %04d tab#%02d%c', 0, 0, $day, 96 + $count - $i);
			else $out[] = sprintf("%d %04d tab#%02d", 0, 0, $day);
		}

		file_put_contents($target, implode("\n", $out));
	}

	function dump_c($target, $tabs)
	{
		file_put_contents($target, sprintf("<%sphp\n%s = array('%s');\n%s>",
			'?', '$c', implode("', '", $tabs), '?'));
	}

	function dump_tag($source, $target, $year, $month, $day, $data)
	{
		$out[] = sprintf("#### 0");
		$out[] = sprintf("%d %s", 0, $source);
		$out[] = sprintf("####");

		$out[] = sprintf('%d %04d p#link#Blog/%s/%s/#<em>@%02d/%s/%s@</em>#%s',
			0, 0, $year, $month, $day, $month, $year, $data['tab']);
		
		$limit = count($data['tags']);
		for ($i = 0; $i < $limit; $i++)
		{
			$out[] = sprintf('%d %04d %s', 0, 0, $i?'&amp;':'/');
			$out[] = sprintf('%d %04d link#About/#%s#%s',
				0, 0, ucwords($data['tags'][$i]),
				mb_strtoupper($data['tags'][$i], 'UTF-8'));
		}

		$out[] = sprintf('%d %04d title#%s', 0, 0, $data['title']);

		foreach (array_keys($data['content']) as $l)
			$out[] = sprintf('%d %04d %s', 0, $l, $data['content'][$l]);
		
		file_put_contents($target, implode("\n", $out));
	}

	function dump_ghost($source, $target, $year, $month, $day, $names)
	{
		$out[] = sprintf("#### 0");
		$out[] = sprintf("%d %s", 0, $source);
		$out[] = sprintf("####");
		
		$limit = count($names);
		for ($i = 0; $i < $limit; $i++) {
			if ($i) $out[] = sprintf('%d %04d %s', 0, 0, 'sec#');
			$out[] = sprintf('%d %04d require@tab@%s#blog/%s/%02d/',
				0, 0, $names[$i], $year, $month);
		}
		
		file_put_contents($target, implode("\n", $out));
	}

	function dump_side($source, $target, $year, $month, $data)
	{
		$out[] = sprintf("#### 0");
		$out[] = sprintf("%d %s", 0, $source);
		$out[] = sprintf("####");
		
		$out[] = sprintf('%d %04d stitle@right#link#Blog/%s/%02d/#%s@ %s',
			0, 0, $year, $month, name_that_month($month), $year);

		foreach (array_keys($data) as $day)
		{
			$i = 0;
			$out[] = sprintf('%d %04d p#<code>%02d/%s</code> –',
				0, 0, $day, $month);

			foreach (array_reverse($data[$day]) as $post)
			{
				if ($i++) $out[] = sprintf('%d %04d %s', 0, 0, '&amp;');
				$out[] = sprintf('%d %04d link#Blog/%s/%s/#%s#%s',
					0, 0, $year, $month, $post['title'], $post['tab']);
			}
		}
		
		file_put_contents($target, implode("\n", $out));
	}

	$_ = explode('/', $argv[2]);
	$limit = count($_);
	$year = $_[$limit - 2];
	$month = substr($_[$limit - 1], 0, 2);

	$current = array();
	$in_rows = file($argv[1], FILE_IGNORE_NEW_LINES);
	$limit = count($in_rows);

	for ($i = 0; $i < $limit; $i++)
	{
		$line = trim($in_rows[$i]);
		if (preg_match('/post#/', $line))
		{
			if (count($current) > 0) $out_rows[$day][] = $current;

			$data = split('#', $line);
			$day = $data[1];
			$title = $data[2];
			if (count($data) > 3) {
				$tags = $data;
				array_shift($tags);
				array_shift($tags);
				array_shift($tags);
			} else $tags = array();

			$current = array();
			$current['title'] = $title;
			$current['tags'] = $tags;
		}
		else $current['content'][$i] = $line;
	}

	if (count($current) > 0) $out_rows[$day][] = $current;

	foreach (array_keys($out_rows) as $day)
	{
		$count = count($out_rows[$day]);

		if ($count > 1)
			for ($i = 0; $i < $count; $i++)
				$out_rows[$day][$i]['tab'] = sprintf('%02d%c', $day, 96 + $count - $i);
		else $out_rows[$day][0]['tab'] = sprintf("%02d", $day);
	}

	foreach (array_keys($out_rows) as $day)
	{
		$limit = count($out_rows[$day]);
		$names = array();

		if ($limit > 1)
		{
			for ($i = 0; $i < $limit; $i++)
			{
				$tab = sprintf('%02d%c', $day, 96 + $limit - $i);
				$names[] = $tab;
				dump_tag($argv[1],
					sprintf('%stab-%s.frag', $argv[4], $tab),
					$year, $month, $day, $out_rows[$day][$i]);
			}
			dump_ghost($argv[1],
				sprintf('%stab-%02d.frag', $argv[4], $day),
				$year, $month, $day, $names);
		}
		else dump_tag($argv[1],
			sprintf('%stab-%02d.frag', $argv[4], $day),
			$year, $month, $day, $out_rows[$day][0]);
	}

	ksort($out_rows);
	$out_rows = array_reverse($out_rows, true);
	list($prev, $next) = scan_for_month($month, $year, $blog_map);
	$to_file[] = sprintf("title#%s %s#Le notizie di %s\n",
		name_that_month($month), $year, name_that_month($month));
	if ($prev)
		$to_file[] = sprintf("prev#Blog/%s/%02d/#%s@ %s\n",
			$prev[0], $prev[1], name_that_month($prev[1]), $prev[0]);
	if ($next)
		$to_file[] = sprintf("next#Blog/%s/%02d/#%s@ %s\n",
			$next[0], $next[1], name_that_month($next[1]), $next[0]);
	$to_file[] = sprintf("tabs#all_or_one\n");
	$to_file[] = sprintf("start#page\n");

	dump_meta($argv[1], sprintf('%smeta.frag', $argv[4]),
		name_that_month($month),
		$year,
		scan_for_month($month, $year, $blog_map),
		$out_rows);
	dump_c($argv[4].'c.php', array_keys($out_rows));
	dump_side($argv[1], sprintf('%sside.frag', $argv[4]),
		$year, $month, $out_rows);
	exit(0);
?>
