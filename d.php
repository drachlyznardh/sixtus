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

	if ($servername == 'localhost') {
		$base = $localbase;
#	} else if ($servername == 'trunaluten.99k.org') {
#		$base = 'http://trunaluten.99k.org';
#	} else if ($servername == 'drachlyznardh.altervista.org') {
#		$base = 'http://drachlyznardh.altervista.org';
	} else if ($servername == 'gods.roundhousecode.com') {
		$base = 'http://gods.roundhousecode.com';
	}

	$request = urldecode(strtolower(substr($_SERVER['REQUEST_URI'], 1)));
	#if ($localhome && $request == '') header ('Location: '.$base.$localhome);

	if ((preg_match('/style/', $request) || preg_match('/extra/',$request)) && file_exists ($request)) {
		
		if (preg_match('/\.css$/', $request)) {
		
			header ('Content-Type: text/css');
			require_once ($request);
			die ();
		}

		if (preg_match('/\.gif$/', $request)) $mime = 'image/gif';
		else if (preg_match('/\.png$/', $request)) $mime = 'image/png';
		else if (preg_match('/\.jpg$/', $request)) $mime = 'image/jpeg';
		else if (preg_match('/\.ico$/', $request)) $mime = 'image/x-icon';
		else header ('Location: '. $base .'/Not/Found/');

		header ('Content-Type: '. $mime);
		$file = fopen ($request, 'r');
		while (!feof($file)) print(fread($file, 1024*1024));
		fclose($file);
		die ();
	
	} else if (preg_match('/lib\/.*\.js/', $request) && file_exists($request)) {
		header ('Content-Type: text/javascript');
		$file = fopen ($request, 'r');
		while (!feof($file)) print(fread($file, 1024*1024));
		fclose($file);
		die ();
	} else if (preg_match('/rss\.xml/', $request)) {
	
		header ('Content-Type: application/rss+xml');
		$file = fopen ('rss.xml', 'r');
		while (!feof($file)) print(fread($file,1024*1024));
		fclose ($file);
		die ();
	}

	$token = explode ('/', $request);

	$voption = array(
		'debug',
		'complete',
		'bounce',
		'download',
		'dynamic',
		'dado',
		'book',
		'pdf');
	$opt = array ();
	$modes = array ('gods','luber','bolo');

	$finder = new Finder ($sources, $voption);
	//echo ($finder->show());

	$amode = 'gods';
	foreach (array_keys($token) as $key) {

		if ($token[$key] == '') {
			unset($token[$key]);
			continue;
		}

		foreach ($voption as $option)
			if ($token[$key] == '') {
				unset ($token[$key]);
				break;
			} else if ($token[$key] == $option) {
				$opt[$option] = $option;
				unset ($token[$key]);
				break;
			} 
		if (isset($token[$key])) foreach ($modes as $mode)
			if ($token[$key] == $mode) {
				$amode = $mode;
				unset ($token[$key]);
				break;
			}
	}
	$search = $finder->find($token);
	
	foreach ($search['category'] as $category)
		$self .= $category .'/';

	if ($search['last'] != 'index')
		$self .= strtoupper($search['last']).'/';

	foreach ($search['destdir'] as $destdir)
		$searchpath .= $destdir .'/';
	$includepath = $searchpath . $search['last'] .'.php';

	if (file_exists($includepath))
		if ($searchpath) $rside = preg_replace ('/\//', '.', $searchpath .'php');
		else $rside = 'nav.php';
	else {
		$includepath = 'error404.php';
		$rside = 'nav.php';
	}

	$d = new Dialog(isset($opt['bounce']), $location, $opt, $amode, $self);

	if (isset ($opt['dynamic'])) {

		if (preg_match('/tmpl\/(.*)\//', $parsed)) {
			$frag = substr($parsed, 0, -1);
			if (file_exists($frag)) include ($frag);
			else include ('frag404.php');
			die();
		}

		list($folder, $file) = explode('/', $file);
		$inner = $srcdir[0].$folder.'.d/'.$file.'.php';
		$outer = $srcdir[0].$folder.'.php';

		if (file_exists($inner)) require_once ($inner);
		else if (file_exists($outer)) require_once ($outer);
		else require_once ('frag404.php');
		die();
	}

	#require_once ($include);
	require_once ($includepath);
	if (isset($opt['book'])) require_once('tmpl/book.php');
	else if (isset($opt['pdf'])) require_once('tmpl/pdf.php');
	else require_once ('tmpl/pager.php');
	die ();

?>
