<?php

	function make_include_filename ($base, $localbase, $filename)
	{
		$dest = $localbase.'/'.$filename;
		if (is_file($dest)) return $dest;

		$dest = $base.$filename;
		if (is_file($dest)) return $dest;

		$dest = $filename;
		if (is_file($dest)) return $dest;

		return false;
	}

	$deps = array();
	$rows = file($argv[1], FILE_IGNORE_NEW_LINES);

	foreach ($rows as $_)
		if (preg_match('/include#/', $_) or preg_match('/include@static#/', $_))
		{
			$request = split('#', $_);
			$include = make_include_filename ($argv[2], dirname($argv[1]), $request[1]);
			$deps[] = $include;
		}

	file_put_contents($argv[4], sprintf('%s: %s', $argv[3], implode(' ', $deps)));
	die();
?>
