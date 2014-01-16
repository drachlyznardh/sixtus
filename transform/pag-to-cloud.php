<?php

	### Args
	# 0 : this PHP script
	# 1 : source .PAG file
	# 2 : naked filename for this page
	# 3 : reverse map file
	# 4 : destination directory

	require_once('runtime-utils.php');

	### reading source
	function scan_for_tags ($filename)
	{
		$result     = array();
		$environment = 'page';
		$pagetitle   = false;

		$rows = file($filename, FILE_IGNORE_NEW_LINES);

		foreach ($rows as $_)
		{
			if (preg_match('/tag#/', $_))
			{
				$data = split('#', strtolower($_));
				array_shift($data);
				foreach ($data as $d) $result[$environment][$d] = true;
			}
			else if (preg_match('/title#/', $_))
			{
				$data = split('#', $_)[1];
				$data = str_replace('\'', '&apos;', $data);
				if (!isset($pagetitle[$environment]))
					$pagetitle[$environment] = $data;
			}
			else if (preg_match('/stop#/', $_))
				$environment = 'page';
			else if (preg_match('/tab#/', $_))
				$environment = split('#', $_)[1];
		}
		return array($pagetitle, $result);
	}

	### search this page's canonical name
	function scan_for_canonical ($map_file, $name)
	{
		require_once($map_file);

		$data = split('/', $name);
		$limit = count($data) - 1;
		$short = $data[0];
		for ($i = 1; $i < $limit; $i++) $short .= '/'.$data[$i];
		$long = $short.'/'.$data[$limit];

		if (isset($reverse[$short]))
			$result = $reverse[$short].strtoupper($data[$limit]).'/';
		else if (isset($reverse[$long]))
			$result = $reverse[$long].'/';
		else $result = false;

		#printf("Canonical for [%s] is [%s]\n", $name, $result);
		return $result;
	}

	function prepare_directories_for ($target)
	{
		#printf("\tPreparing directories for %s\n", $target);
		$data = split('/', $target);
		$limit = count($data) - 1;
		$acc = false;
		for ($i = 0; $i < $limit; $i++)
		{
			$acc .= $data[$i].'/';
			#printf("\t mkdir %s\n", $acc);
			if (!is_dir($acc)) mkdir($acc, 0755);
		}
	}

	function update_tag_file ($target, $page, $tab, $title)
	{
		#printf("Now adding [%s][%s] = [%s] to [%s]\n", $page, $tab, $title, $target);

		if (is_file($target)) require($target);
		else prepare_directories_for ($target);

		$tag[$page][$tab] = $title;

		$to_file[] = sprintf("%s%s\n", '<', '?php');
		foreach (array_keys($tag) as $_)
			foreach (array_keys($tag[$_]) as $__)
				$to_file[] = sprintf("\t%s['%s/']['%s'] = '%s';\n",
					'$tag', $_, $__, $tag[$_][$__]);
		$to_file[] = sprintf("%s%s", '?', '>');

		file_put_contents($target, $to_file);

		return count($tag);
	}

	list($titles, $taglist) = scan_for_tags($argv[1]);
	$canonical_name = scan_for_canonical($argv[3], $argv[2]);
	#print_r($titles);
	#print_r($taglist);
	
	$cloud_file = $argv[4].'cloud.php';
	if (is_file($cloud_file)) require_once($cloud_file);
	foreach (array_keys($taglist) as $env)
		foreach (array_keys($taglist[$env]) as $tagname)
		{
			#printf("\tPage[%s][%s] as tag [%s]\n",
			#	$titles[$env], $env, $tagname);
			$tagfile = $argv[4].get_tag_filename ($tagname);
			$cloud[$tagname] = update_tag_file($tagfile, $canonical_name, $env, $titles[$env]);
		}
	
	#print_r($cloud);
	$to_file[] = sprintf("%s%s\n", '<', '?php');
	foreach (array_keys($cloud) as $_)
			$to_file[] = sprintf("\t%s['%s'] = %s;\n",
				'$cloud', $_, $cloud[$_]);
	$to_file[] = sprintf("%s%s", '?', '>');
	file_put_contents($cloud_file, $to_file);
?>
