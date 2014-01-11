<?php

	print_r($argv);

	# Load map
	require_once($argv[2]);

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
