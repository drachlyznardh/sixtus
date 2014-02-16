<?php

	#require_once('runtime.php');
	require_once('conf.php');
	require_once('resolve.php');
	require_once('utils.php');
	require_once('db-utils.php');

	require_once('mimes.php');
	require_once('direct-map.php');

	$request['original'] = mb_strtolower(urldecode($_SERVER['REQUEST_URI']), 'UTF-8');
	$request['part'] = false;
	
	$attr['included'] = false;
	$attr['sections'] = true;
	$attr['force_all_tabs'] = false;
	$attr['all_or_one'] = false;
	$attr['gray'] = true;
	$attr['single'] = true;
	$attr['layout'] = 0;

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
			exit(0);
		} else {
			require_once('sys/404-not-found.php');
			exit(0);
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
				$attr['layout'] = 0;
				unset($token[$key]);
				break;
			case 'all':
				$attr['single'] = false;
				$attr['layout'] = 1;
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
			$request['part'] = $page_tab;
		} else {
			$request['path'][] = $_;
		}
	}

	$target_dir = docroot().search_for_dir($direct, $attr, $request['path']);
	$target_file = "${target_dir}meta.php";

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
	else require_once('404-not-found.php');

	if (!$request['part'] && $c[0] != 'default') $request['part'] = $c[0];
	$heading = extract_heading_path($attr, $request['path'], $request['part'], $direct);
	if (!$request['part']) $request['part'] = $c[0];
	$attr['self'] = find_self($heading);
	#$lwself = strtolower($attr['self']);

	$s = true; // Display sections
	$attr['part'] = $request['part']; // For internal links

	### Outputting page
	require_once('page-top.php');
	if ($attr['layout'])
		require_once($target_dir.'content.php');
	else 
		require_once($target_dir.'tab-'.$request['part'].'.php');
	require_once('page-middle.php');
	if (is_file($target_dir.'side.php')) require_once($target_dir.'side.php');
	require_once('page-bottom.php');

	exit(0);
?>
