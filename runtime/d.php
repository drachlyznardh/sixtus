<?php

	require_once('runtime.php');
	require_once('conf.php');
	require_once('utils.php');
	require_once('mimes.php');

	$request['original'] = urldecode(strtolower($_SERVER['REQUEST_URI']));
	
	$attr['included'] = false;
	$attr['sections'] = true;
	$attr['part'] = false;
	$attr['current'] = false;
	$attr['force_all_tabs'] = false;
	$attr['all_or_one'] = false;
	$attr['gray'] = true;
	$attr['single'] = true;

	$attr['download'] = false;
	$attr['check'] = false;

	$direct_access_file = $_SERVER['DOCUMENT_ROOT'].substr($request['original'], 1);

	if (is_file($direct_access_file)) {

		$token = preg_split('/\./', $direct_access_file);
		$extension = $token[count($token) -1];

		if (isset($mimetypes[$extension])) {
			$mimetype = $mimetypes[$extension];
			header("Content-Type: $mimetype");
			readfile($direct_access_file);
			die();
		} else {
			require_once('sys/404-not-found.php');
			die();
		}
	}

	$index = strpos($request['original'], '?');
	if ($index !== false) $request['original'] = substr($request['original'], 0, $index);
	$_ = strtok($request['original'], '/');
	$token = array();
	while ($_ !== false) {
		$token[] = $_;
		$_ = strtok('/');
	}

	foreach (array_keys($token) as $key) {
		switch ($token[$key]) {
			case '':
				unset($token[$key]);
				break;
			case 'gray':
				$attr['gray'] = true;
				unset($token[$key]);
				break;
			case 'white':
				$attr['gray'] = false;
				unset($token[$key]);
				break;
			case 'single':
				$attr['single'] = true;
				unset($token[$key]);
				break;
			case 'all':
				$attr['single'] = false;
				unset($token[$key]);
				break;
			case 'download':
				$attr['download'] = true;
				unset($token[$key]);
				break;
			case 'check':
				$attr['check'] = true;
				unset($token[$key]);
				break;
		}
	}

	// In case of empty request, redirect onto HomePage
	if (count($token) == 0) header("Location: $runtime[home]");

	foreach ($token as $_) {
		if (preg_match('/§/', $_)) {
			list($page_name, $page_tab) = preg_split('/§/', $_);
			$request['path'][] = $page_name;
			$attr['part'] = $page_tab;
			$attr['current'] = $page_tab;
		} else {
			$request['path'][] = $_;
		}
	}

	function search_for_page ($attr, $path)
	{
		require_once('direct-map.php');

		$short = false;
		$limit = count($path) - 1;
		for ($i = 0; $i < $limit; $i++) $short .= ucwords($path[$i]).'/';
		$long = $short.ucwords($path[$limit]).'/';

		if (preg_match('/blog/', $path[0]))
		{
			$target = sprintf("%spage.php", strtolower($long));
		}
		else if (isset($direct[$long]))
		{
			#printf ("Found [%s] Long\n", $long);
			$target = sprintf("%s/page.php", strtolower($direct[$long]));
		}
		else if (isset($direct[$short]))
		{
			#printf ("Found [%s] Short\n", $short);
			$target = sprintf("%s/%s/page.php",
				strtolower($direct[$short]), $path[$limit]);
		}
		else $target = false;

		return $target;
	}

	$myindex = 0;
	$mycount = count($request['path']);
	$mymap = $map;
	$mycat = false;
	$mypath = $request['path'][0];
	$search['dir'] = '.';
	$search['file'] = 'index';
	while (1) {
		if (is_array($mymap) && isset($mymap[$mypath])) {
			$mymap = $mymap[$mypath];
			$mycat .= ucwords($mypath).'/';
			$search['cat'][] = array($mycat, ucwords($mypath));

			if (is_array($mymap)) $search['dir'] = $mymap[0];
			else $search['dir'] = $mymap;
		
			$myindex++;
			if ($myindex < $mycount) {
				$mypath = $request['path'][$myindex];
			} else break;
		} else {
			$search['file'] = $mypath;
			$mycat .= strtoupper($mypath).'/';
			$search['page'] = array($mycat, strtoupper($mypath));
			break;
		}
	}
	
	if ($attr['download']) $search['include'] = $search['dir'] .'/'. $search['file'].'.pdf';
	else $search['include'] = $search['dir'] .'/'. $search['file'] .'.php';

	if (isset($search['page'])) $attr['self'] = $search['page'][0];
	else $attr['self'] = $search['cat'][count($search['cat']) - 1][0];

	function find_self($map)
	{
		$limit = count($map) - 1;
		for ($i = 0; $i < $limit; $i++)
			$self[] = sprintf('%s/', ucwords($map[$i]));
		if ($limit) $self[] = sprintf('%s/', strtoupper($map[$limit]));
		else $self[] = sprintf('%s/', ucwords($map[$limit]));
		return implode($self);
	}

	$attr['self'] = find_self($request['path']);

	$target_file = $_SERVER['DOCUMENT_ROOT'].search_for_page($attr, $request['path']);
	#require_once($target_file);
	
	if (is_file($target_file))
		require_once($target_file);
	else require_once('404-not-found.php');
	die();

	if ($attr['download'] && is_file($search['include'])) {
		header('Content-Type: application/pdf');
		header('Content-Disposition: attachment; filename="'.$search['file'].'.pdf"');
		readfile($search['include']);
	} else if (is_file($search['include']))
		require_once($search['include']);
	else require_once('runtime/404-not-found.php');
	die();
?>
