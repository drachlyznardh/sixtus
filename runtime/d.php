<?php

	require_once('conf.php');
	require_once('resolve.php');
	require_once('utils.php');
	require_once('db-utils.php');
	require_once('direct-map.php');

	function check_direct_file_access ($target)
	{
		require_once('mimes.php');
		if (is_file($target))
		{
			$extension = end(split('\.', $target));
			if (isset($mimetypes[$extension]))
			{
				$mimetype = $mimetypes[$extension];
				header("Content-Type: $mimetype");
				readfile($target);
				exit(0);
			}
		}
	}

	function tabs_to_display ($layout, $requested, $list)
	{
		switch ($layout)
		{
			case 0: # One Tab / Pages
			case 2: # Just one tab / Special request
				if ($requested) return array($requested);
				return array($list[0]);
			case 1: # One tab for all / Blog months
				if ($requested) return array($requested);
				return $list;
			case 3: # All tabs / Listings, indexes
				return $list;
		}
	}

	function parse_request ($request, $styles)
	{
		$style = false;
		$layout = 0;
		$download = false;
		$check = false;
		$path = array();
		$part = false;

		foreach (split('/', $request) as $token) switch ($token)
		{
			case '': break;
			case 'one-tab': $layout = 0; break;
			case 'all-tabs': $layout = 3; break;
			case 'download': $download = true; break;
			case 'check': $check = true; break;

			default: $next[] = $token;
		}

		foreach ($next as $token) 
		{
			$found = false;
			foreach ($styles as $current)
				if (strcmp($token, $current) == 0)
				{
					$style = $current;
					$found = true;
					break;
				}
			if (!$found) $nnext[] = $token;
		}

		foreach ($nnext as $token)
			if (preg_match('/§/', $token)) {
				list($piece, $part) = preg_split('/§/', $token);
				$path[] = $piece;
			} else $path[] = $token;
	
		return array($style, $layout, $download, $check, $path, $part);
	}

	$request['original'] = mb_strtolower(urldecode($_SERVER['REQUEST_URI']), 'UTF-8');
	check_direct_file_access(docroot().substr($request['original'], 1));

	$layout = array('one-tab', 'one-tab-for-all', 'just-one-tab', 'all-tabs');

	$attr['style'] = $attr['defstyle'] = $style[0];
	$attr['layout'] = false;
	$attr['ct'] = 0;

	$attr['download'] = false;
	$attr['check'] = false;
	$request['part'] = false;

	list($attr['style'], $attr['layout'],
		$attr['download'], $attr['check'],
		$request['path'], $request['part']) = parse_request($request['original'], $style);

	$target_dir = docroot().search_for_dir($direct, $attr, $request['path']);
	$target_file = sprintf('%smeta.php', $target_dir);

	if ($attr['download'])
	{
		$target_file_size = strlen($target_file_size);
		$target_file = sprintf('%s.pdf', substr($target_file, 0, $target_file_size - 9));

		if (is_file($target_file)) {
			header('Content-Type: application/pdf');
			header('Content-Disposition: attachment; filename="'.$heading['page'][0].'.pdf"');
			readfile($search['include']);
			exit(0);
		}
	}

	if (is_file($target_file))
		require_once($target_file);
	else require_once('404/meta.php');

	if (!$ct) $ct = $attr['layout'];
	if (!$attr['style']) $attr['style'] = $style[0];

	#if (!$request['part'] && !$ct && count($c[0]) > 1) $request['part'] = $c[0];
	$heading = extract_heading_path($attr, $request['path'], $request['part'], $direct);
	$attr['self'] = find_self($heading);
	#$lwself = strtolower($attr['self']);

	$s = true; // Display sections
	if ($request['part']) $attr['part'] = $request['part']; // For internal links
	else $attr['part'] = $c[0];

	### Outputting page
	require_once('page/top.php');
	foreach (tabs_to_display($ct, $request['part'], $c) as $_)
	{
		$targetfile = "$target_dir/tab-$_.php";
		if (is_file($targetfile))
			require ("$target_dir/tab-$_.php");
		else missing_tab($_);
	}
	require_once('page/middle.php');
	if (is_file($target_dir.'side.php')) require_once($target_dir.'side.php');
	require_once('page/bottom.php');

	exit(0);
?>
