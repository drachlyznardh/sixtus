<?php

	require_once("sys/runtime.php");
	require_once("sys/utils.php");
	require_once("sys/mimes.php");

	$request['original'] = urldecode(strtolower($_SERVER['REQUEST_URI']));
	$request['tab'] = false;
	$attr['theme'] = 'gray';
	$attr['tabs'] = 'singletab';

	$direct_access_file = substr($request['original'], 1);

	if (is_file($direct_access_file)) {

		$token = preg_split('/\./', $direct_access_file);
		$extension = $token[count($token) -1];

		if (isset($mimetypes[$extension])) {
			$mimetype = $mimetypes[$extension];
			header("Content-Type: $mimetype");
			readfile($direct_access_file);
			die();
		} else {
			#require_once('sys/403-forbidden.php');
			require_once('sys/404-not-found.php');
			die();
		}
	}

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
			case 'white':
				$attr['theme'] = $token[$key];
				unset($token[$key]);
				break;
			case 'singletab':
			case 'alltabs':
				$attr['tabs'] = $token[$key];
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
			$request['tab'] = $page_tab;
		} else {
			$request['path'][] = $_;
		}
	}

	$myindex = 0;
	$mycount = count($request['path']);
	$mymap = $map;
	$mycat = false;
	$mypath = $request['path'][0];
	$search['dir'] = '.';
	$search['file'] = 'index.php';
	while (1) {
		if (isset($mymap[$mypath])) {
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
			$search['file'] = $mypath . '.php';
			$mycat .= strtoupper($mypath).'/';
			$search['page'] = array($mycat, strtoupper($mypath));
			break;
		}
	}
	$search['include'] = $search['dir'] .'/'. $search['file'];

?>
<!DOCTYPE html>
<!-- $Request[Original] = [<?=$request['original']?>] -->
<!-- $Attr[Theme] = [<?=$attr['theme']?>], $Attr[Tabs] = [<?=$attr['tabs']?>] -->
<!-- $Request[Path] = [<?php
	$other=false;
	foreach ($request['path'] as $key)
		if ($other) { echo"; $key"; }
		else { $other=true; echo"$key"; }
?>] -->
<!-- $Search[Dir] = [<?=$search['dir']?>], $Search[File] = [<?=$search['file']?>], $Search[Include] = [<?=$search['include']?>] -->
<?php
	
	if (is_file($search['include']))
		require_once($search['include']);
	else require_once('sys/404-not-found.php');
	die();
?>
