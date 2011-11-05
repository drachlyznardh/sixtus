<?php

	/* Set up configuration */
	$servername = $_SERVER['SERVER_NAME'];
	
	/* Set Admin data */
	$admin['name'] = 'simak';
	$admin['pass'] = '020eb5a55e7b0512016dd9e182312438';

	session_name('lyzid');
	session_start();

	if (isset($_POST['action'])) {
	
		if (strcmp($_POST['action'], 'login') == 0) {
			$name = mysql_real_escape_string ($_POST['name']);
			$pass = mysql_real_escape_string ($_POST['pass']);

			if (strcmp($name, $admin['name']) == 0 &&
			strcmp(md5($pass), $admin['pass']) == 0) {
				$_SESSION['login'] = true;
				$_SESSION['name'] = $name;
			}
		} else if (strcmp($_POST['action'], 'logout') == 0) {
			$_SESSION = array();
			session_destroy();
		}
	}

	session_write_close();
	require_once ('sources.php');
	require_once ('lib/finder.php');
	require_once ('lib/dialog.php');

	#require_once ('lib/pager.php');
	require_once ('sys/pager.php');

	$request = urldecode(strtolower(substr($_SERVER['REQUEST_URI'], 1)));
	if ($request == '' && isset($conf['home'])) header ("Location: $conf[home]");

	if (is_file($request)) {
		$token = preg_split ('/\./', $request);
		$ext = $token[count($token) - 1];
		if (isset($conf['mimes'][$ext])) $mime = $conf['mimes'][$ext];
		else die ("Extension [$ext] is not recognized.");

		header ("Content-Type: $mime");
		readfile ($request);
		die();
	}

	$token = explode ('/', $request);
	$opt['mode'] = 'Gods';
	$opt['style'] = 'Raw';
	foreach (array_keys($token) as $key) {
	
		switch ($token[$key]) {
			case '':
				#echo ('<p>Empty token!</p>');
				unset($token[$key]);
				break;
			case 'gods':
			case 'bolo':
			case 'luber':
				$opt['mode'] = ucwords($token[$key]);
				#echo ('<p>Mode ['.$opt['mode'].']</p>');
				unset($token[$key]);
				break;
			case 'dado':
			case 'raw':
				$opt['style'] = ucwords($token[$key]);
				#echo ('<p>Style ['.$opt['style'].']</p>');
				unset($token[$key]);
				break;
			case 'debug':
				$opt['debug'] = 'debug';
				#echo ('<p>Debug ['.$opt['debug'].']</p>');
				unset($token[$key]);
				break;
			case 'download':
				$opt['download'] = 'download';
				#echo ('<p>Download ['.$opt['download'].']</p>');
				unset($token[$key]);
				break;
		}
	}

	$token = implode ('/', $token);
	#echo ('<p>Token: ');print_r($token);echo('</p>');
	if (preg_match('/§/', $token)) list($token, $tab['name']) = preg_split ('/§/', $token);
	else $tab['name'] = false;
	#echo ('<p>Token: ');print_r($token);echo('</p>');
	$token = preg_split ('/\//', $token);
	#echo ('<p>Token: ');print_r($token);echo('</p>');

	$finder = new Finder ($sources);
	#echo ($finder->show());

	$search = $finder->find($token);
	$searchpath = $search['destdir'] .'/';

	#echo ('<p>Token: ');print_r($token);echo('</p>');
	#echo ('<p>Category: ');print_r($search['category']);echo('</p>');
	#echo ('<p>Tab[name]: '.$tab['name'].'</p>');

	$self = false;
	foreach ($search['category'] as $category)
		$self .= $category .'/';

	$last = $search['last'];
	if ($last != 'index') {
		$pagename = $last;
		$self .= strtoupper($last).'/';
	}

	$page = $searchpath.$last.'.php';
	$tab['dir'] = $searchpath.$last.'.d/';
	$tab['req'] = substr($self, 0, -1).'§';

	#echo ('<p>Page ['.$page.']</p>');
	#echo ('<p>Self ['.$self.']</p>');
	#echo ('<p>');print_r($tab);echo('</p>');

	if (isset($opt['download'])) {
		$pdfpath = $searchpath . $search['last'] .'.pdf';
		if (file_exists($pdfpath)) {
			header('Content-Type: application/pdf');
			header('Content-Disposition: attachment; filename="'.$search['last'].'.pdf"');
			readfile($pdfpath) or die('Cannot transmit PDF file');
			die ();
		} else die('File ['. $pdfpath .'] does not exist.');
	}

	if (file_exists($page))
		if ($searchpath) $rside = 'tmpl/side/'. preg_replace ('/\//', '.', $searchpath) .'php';
		else $rside = false;
	else {
		$page = 'error404.php';
		$rside = false;
	}

	$d = new Dialog($opt, $self, $tab);
	$p = new Pager($d);

	$p->prepare ($page, true, true, true);
	require_once ('sys/skeleton.php');
	die ();

	/* 
	$tab['name'] or $tab['name'] = $p->defaulttab();

	function arrayfill ($array) {
		switch (count($array)) {
			case 1: $array[1] = false;
			case 2: $array[2] = false;
			case 3: $array[3] = false;
		}
		return $array;
	}

	if (isset($title)) $p->addmetas('title', arrayfill($title));
	if (isset($prev)) $p->addmetas('prev', arrayfill($prev));
	if (isset($next)) $p->addmetas('next', arrayfill($next));
	/* ERASE ME */

	$tab['name'] or $tab['name'] = $p->defaulttab();
	require_once ('sys/skeleton.php');
	die ();
?>
