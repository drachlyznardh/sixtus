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
			$found = array_reverse($found, true);
			printf("Found for %s %s:\n", $year, $month);
			print_r($found);
		
			while ($counter < $post_limit && count($found) > 0)
			{
				$key = array_keys($found)[0];
				printf("Now recording %s %s %s %s\n",
					$year, $month, $key, $found[$key]);
				$result[$counter] = array($year, $month, $key, $found[$key]);
				$sides[$year][$month] = true;
				array_shift($found);
				$counter++;
			}

/*
			$day = 0; $prev_day = 0;
			foreach ($source_rows as $row) if (preg_match('/^post#/', $row))
			{
				$data = split('#', $row);
				$prev_day = $day;
				$day = $data[1];
			
				#printf("Check %s vs %s on counter %s\n", $prev_day, $day, $counter);
				if ($day == $prev_day) {
					$score = $result[$counter - 1][3];
					$result[$counter - 1][3] = $score + 1;
				} else {
					$sides[$year][$month] = true;
					$result[$counter] = array($year, $month, $data[1], 1);
					$counter++;
				}

				if ($counter >= 15) break 3;
			}
*/
		}
	}

	#print_r($result);
	#print_r($sides);

	$to_file[] = sprintf("title#%s#%s\n", 'Novità', 'Le notizie più recenti');
	$to_file[] = sprintf("next#%s#%s\n", 'Blog/ARCHIVIO/', 'Archivio');
	
	### body
	$to_file[] = sprintf("start#page\n");
	foreach ($result as $_)
	{
		$to_file[] = sprintf("\tsec#\n");
		if ($_[3] == 1)
			$to_file[] = sprintf("\trequire@tab-%s#blog/%s/%s\n",
				$_[2], $_[0], $_[1]);
		else
			for ($i = $_[3]; $i > 0; $i--)
				$to_file[] = sprintf("\trequire@tab-%s%c#blog/%s/%s\n",
					$_[2], 96 + $i, $_[0], $_[1]);
	}
	$to_file[] = sprintf("stop#page\n");
	
	### side
	$to_file[] = sprintf("start#side\n");
	$keys = array_keys($sides);
	$limit = count($keys);
	for ($i = 0; $i < $limit; $i++)
	{
		$_ = $keys[$i];
		if ($i) $to_file[] = sprintf("\tsec#\n");
		$to_file[] = sprintf("\trequire@side#blog/%s/%s\n",
			$_, array_keys($sides[$_])[0]);
	}
	$to_file[] = sprintf("stop#side\n");

	file_put_contents($argv[1], $to_file);

?>
