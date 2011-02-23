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

	if ($servername == 'localhost') {
		$base = 'http://localhost/faiv';
	} else if ($servername == 'trunaluten.99k.org') {
		$base = 'http://trunaluten.99k.org';
	} else if ($servername == 'drachlyznardh.altervista.org') {
		$base = 'http://drachlyznardh.altervista.org';
	}

	$request = substr($_SERVER['REQUEST_URI'], 1);
	if (preg_match ('/faiv\//', $request))
		$request = preg_replace ('/faiv\/(.*)/', '$1', $request);
	if ($request == '')
		header ('Location: '.$base.'/Storie/');

	if (preg_match('/style/', $request) && file_exists ($request)) {
		
		if (preg_match('/\.css$/', $request)) {
		
			header ('Content-Type: text/css');
			require_once ($request);
			die ();
		}

		if (preg_match('/\.gif$/', $request)) $mime = 'image/gif';
		else if (preg_match('/\.png$/', $request)) $mime = 'image/png';
		else if (preg_match('/\.ico$/', $request)) $mime = 'image/x-icon';
		else header ('Location: '. $base .'/Not/Found/');

		header ('Content-Type: '. $mime);
		#header ('Content-Type: text/html');
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
	$voption = array('debug','complete','bounce','download','dynamic','book','pdf');
	$opt = array ();
	foreach (array_keys($token) as $key) {
		foreach ($voption as $option)
		if ($token[$key] == '') {
			unset ($token[$key]);
			break;
		} else if ($token[$key] == $option) {
			$opt[$option] = $option;
			unset ($token[$key]);
			break;
		} 
	}
	$parsed = strtolower(implode('/', $token).'/');

	require_once ('sources.php');
	
	$section = false;
	$location = false;
	$file = false;
	$srcdir = array ();
	$include = false;
	$rside = false;

	foreach (array_keys($cats) as $key) {
		if (preg_match($key, $parsed)) {
			$location = preg_replace('/\\\/', '',substr($key, 1, -1));
			$section = ucwords(preg_replace('/\//',' ',$location));
			$location = preg_replace('/ /','/',$section);
			$file = strtolower(substr(preg_replace($key, '', $parsed), 0, -1));
			$srcdir = $cats[$key];
			break;
		}
	}
	if (!$file) $file = 'index';
	if (!$section) $section = '/';
	if (!$location) $location = 'Storie/';
	if (isset($opt['download'])) {
		foreach ($srcdir as $dir) {
			$include = $dir.$file.'.pdf';
			if (file_exists($include)) {
				header('Content-Type: application/pdf');
				header('Content-Disposition: attachment; filename='.$file.'.pdf');
				if ($stream = fopen($include,'r')){
					while(!feof($stream))
						print(fread($stream,1024));
					fclose($stream);
				}
				die();
			}
		}
	}
	foreach ($srcdir as $dir) {
		if (file_exists($dir.$file.'.php')) {
			$include = $dir.$file.'.php';
			$rside = preg_replace ('/\//','.',$dir).'php';
			break;
		}
	}
	if (!$include) $include = 'error404.php';
	if (!$rside) $rside = 'nav.php';

	require_once ('lib/dialog.php');

	$d = new Dialog(isset($opt['bounce']), $location, $opt);

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

	require_once ($include);
	if (isset($opt['book'])) require_once('tmpl/book.php');
	else if (isset($opt['pdf'])) require_once('tmpl/pdf.php');
	else require_once ('tmpl/pager.php');
	die ();

?>
