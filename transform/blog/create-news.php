<?php

	print_r($argv);

	# Load map
	require_once($argv[2]);
	$reverse = array_reverse($blog_map);
	$years = array_keys($reverse, true);
	$key = 0;
	$result = array();
	$counter = 0;

	print_r($reverse);

	while ($counter < 11)
	{
		$target = $reverse[$years[$key]];
		$i = count($target) - 1;

		while ($counter < 11 && $i > -1)
		{
			$result[$counter][] = $years[$key];
			$result[$counter][] = $target[$i];
			printf("Getting %s/%s\n", $years[$key], $target[$i]);
			
			$i--;
			$counter++;
		}

		$key++;
	}

	#print_r($result);

	$to_file[] = sprintf("title#%s#%s\n", 'Novità', 'Le notizie più recenti');
	$to_file[] = sprintf("next#%s#%s\n", 'Blog/ARCHIVIO/', 'Archivio');
	
	### body
	$to_file[] = sprintf("start#page\n");
	$to_file[] = sprintf("stop#page\n");
	
	### side
	$to_file[] = sprintf("start#side\n");
	$to_file[] = sprintf("stop#side\n");

	file_put_contents($argv[1], $to_file);

?>
