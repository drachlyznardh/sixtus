<?php

	$servername = $_SERVER['SERVER_NAME'];
	
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
	require_once ('sys/finder.php');
	require_once ('sys/dialog.php');
	require_once ('sys/pager.php');
	require_once ('sys/parser.php');

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
	$opt['display'] = 'Standard';
	$opt['mode'] = 'Gods';
	$opt['style'] = 'Raw';
	foreach (array_keys($token) as $key) {
	
		switch ($token[$key]) {
			case '':
				unset($token[$key]);
				break;
			case 'standard':
			case 'undecorated':
				$opt['display'] = ucwords($token[$key]);
				unset($token[$key]);
				break;
			case 'gods':
			case 'bolo':
			case 'luber':
				$opt['mode'] = ucwords($token[$key]);
				unset($token[$key]);
				break;
			case 'dado':
			case 'raw':
				$opt['style'] = ucwords($token[$key]);
				unset($token[$key]);
				break;
			case 'debug':
				$opt['debug'] = 'debug';
				unset($token[$key]);
				break;
			case 'download':
				$opt['download'] = 'download';
				unset($token[$key]);
				break;
		}
	}

	$token = implode ('/', $token);
	if (preg_match('/§/', $token)) list($token, $tab['name']) = preg_split ('/§/', $token);
	else $tab['name'] = false;
	$token = preg_split ('/\//', $token);

	$finder = new Finder ($sources);

	$search = $finder->find($token);
	$searchpath = $search['destdir'] .'/';

	$self = false;

	$search or die ('No Search Result');
	$search['category'] or die ('No Categories');

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
		if ($searchpath) $rside = 'sys/side/'. preg_replace ('/\//', '.', $searchpath) .'php';
		else $rside = false;
	else {
		$page = 'error404.php';
		$rside = false;
	}

	$d = new Dialog($opt, $self, $tab);

	$p = new Parser($d);
	$p->parse ($page);
	$tab['name'] or $tab['name'] = $p->getDefaultTab();
	
	switch ($opt['display']) {
		case 'Undecorated':
			require_once ('sys/display/undecorated.php');
			break;
		default: require_once ('sys/skeleton.php');
	}

	die ();
?>
