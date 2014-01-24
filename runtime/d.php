<?php

	#require_once('runtime.php');
	require_once('conf.php');
	require_once('resolve.php');
	require_once('utils.php');
	require_once('db-utils.php');

	require_once('mimes.php');
	require_once('direct-map.php');

	$request['original'] = urldecode(mb_strtolower($_SERVER['REQUEST_URI'], 'UTF-8'));
	
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

	$direct_access_file = docroot().substr($request['original'], 1);

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

	$heading = extract_heading_path($attr, $request['path'], $attr['part'], $direct);
	$attr['self'] = find_self($heading);

	$target_file = docroot().search_for_page($direct, $attr, $request['path']);

	if ($attr['download'])
	{
		$target_file_size = strlen($target_file_size);
		$target_file = sprintf('%s.pdf', substr($target_file, 0, $target_file_size - 9));

		if (is_file($target_file)) {
			header('Content-Type: application/pdf');
			header('Content-Disposition: attachment; filename="'.$heading['page'][0].'.pdf"');
			readfile($search['include']);
			die();
		}
	}

	if (is_file($target_file))
		require_once($target_file);
	else require_once('404-not-found.php');
	die();
?>
