<?php

	print_r($argv);

	# Load map
	require_once($argv[2]);

	$post_limit = 15;
	$counter = 0;
	foreach (array_reverse(array_keys($blog_map)) as $year)
	{
		#printf("\tNow in the year %s\n", $year);
		foreach (array_reverse($blog_map[$year]) as $month)
		{
			#printf("\t\tNow in the %s / %s\n", $month, $year);

			$source_file = sprintf('%s%s/%s.post', $argv[3], $year, $month);
			#printf("\t\tNow loading [%s]\n", $source_file);

			$source_rows = file($source_file, FILE_IGNORE_NEW_LINES);

			### Need to read whole file, than keep only the needed number posts
			$found = array();
			foreach ($source_rows as $row) if (preg_match('/^post#/', $row))
			{
				$data = split('#', $row);
				$day = $data[1];
				if (isset($found[$day])) $found[$day] += 1;
				else $found[$day] = 1;
			}

			ksort($found);
			$keys = array_reverse(array_keys($found));
		
			while ($counter < $post_limit && count($keys) > 0)
			{
				$key = $keys[0];
				$result[$counter] = array($year, $month, $key, $found[$key]);
				$sides[$year][$month] = true;
				array_shift($keys);
				$counter++;
			}
		}
	}

	#print_r($result);
	#print_r($sides);

	$to_file[] = sprintf("title#%s#%s\n", 'Novità', 'Le notizie più recenti');
	$to_file[] = sprintf("next#%s#%s\n", 'Blog/ARCHIVIO/', 'Archivio');
	
	### body
	$to_file[] = sprintf("start#page\n");
	$keys = array_keys($result);
	$limit = count($keys);
	for ($i = 0; $i < $limit; $i++)
	{
		$_ = $result[$keys[$i]];
		if ($i) $to_file[] = sprintf("\tsec#br\n");
		if ($_[3] == 1)
			$to_file[] = sprintf("\trequire@tab-%s#blog/%s/%s\n",
				$_[2], $_[0], $_[1]);
		else
			for ($j = $_[3]; $j > 0; $j--)
			{
				if ($j) $to_file[] = sprintf("\tsec#\n");
				$to_file[] = sprintf("\trequire@tab-%s%c#blog/%s/%s\n",
					$_[2], 96 + $j, $_[0], $_[1]);
			}
	}
	$to_file[] = sprintf("stop#page\n");
	
	### side
	$to_file[] = sprintf("start#side\n");
	$keys = array_keys($sides);
	$limit = count($keys);
	for ($i = 0; $i < $limit; $i++)
	{
		$_ = $keys[$i];
		if ($i) $to_file[] = sprintf("\tsec#br\n");
		$to_file[] = sprintf("\trequire@side#blog/%s/%s\n",
			$_, array_keys($sides[$_])[0]);
	}
	$to_file[] = sprintf("stop#side\n");

	file_put_contents($argv[1], $to_file);

?>
