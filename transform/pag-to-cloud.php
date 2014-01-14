<?php

	### Args
	# 0 : this PHP script
	# 1 : source .PAG file
	# 2 : fake target .TCH file
	# 3 : database directory
	print_r($argv);

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
		return $result;
	}

	$taglist = scan_for_tags($argv[1]);
	print_r($taglist);

?>
