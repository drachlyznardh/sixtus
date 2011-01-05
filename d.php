<?php

	/* Set up configuration */
	$servername = $_SERVER['SERVER_NAME'];
	
	/* Set Admin data */
	$admin['name'] = 'simak';
	$admin['password'] = '020eb5a55e7b0512016dd9e182312438';

	if ($servername == 'localhost') {

		$site = '/opt/lampp/htdocs/faiv/';
		$base = 'http://localhost/faiv';
		$db_name = 'trunaluten';
		$db_user = 'root';
		$db_pass = 'lamorte';

	} else if ($servername == 'trunaluten.99k.org') {
	
		$site = './';
		$base = 'http://trunaluten.99k.org';
		$db_name = 'trunaluten_99k_pages';
		$db_user = '236153_lyznardh';
		$db_pass = 'sexsecretgod';

	} else if ($servername == 'drachlyznardh.altervista.org') {
	
		$site = './';
		$base = 'http://drachlyznardh.altervista.org';
	}

	$request = $_SERVER['REQUEST_URI'];
	if (preg_match ('/\/(.*)/', $request)) $request = preg_replace ('/\/(.*)/', '$1', $request);
	if (preg_match ('/faiv\//', $request)) $request = preg_replace ('/faiv\/(.*)/', '$1', $request);

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
	
		header ('Content-Type: text/xml');
		$file = fopen ('rss.xml', 'r');
		while (!feof($file)) print(fread($file,1024*1024));
		fclose ($file);
		die ();
	}

	/* Load libraries */
	$tmpl  = $site .'tmpl/';
	$sides = $tmpl .'side/';
	$forms = $tmpl .'form/';
	$lib   = $site .'lib/';

	require_once ($lib .'pagemaster.php');
	require_once ($lib .'dialog.php');
	require_once ($lib .'util.php');

	$sources['Not'] = array (
		'src' => './',
		'ext' => 'php',
	);

	require_once ('sources.php');

	$master = new PageMaster ($sources);
	$master->parse($request);

	if ($master->download) {
		 
		$path = $master->source['src'] .'/'. $master->file .'.'. $master->source['download'];

		header ('Content-Type: '. $master->source['mime']);
		header ('Content-Disposition: attachment; filename='. $master->file .'.'. $master->source['download']);
		
		$file = fopen ($path, 'r');

		if ($file) {
			while (!feof($file)) print(fread($file, 1024*1024));
			fclose ($file);
			die ();
		} else $master->mkNotFound();
	}

	$d = new Dialog($master->bounce);

	if ($master->file) {
		if (is_array($master->source['src'])) {
		
			foreach ($master->source['src'] as $src) {
			
				$path = $src .'/'. $master->file .'.'. $master->source['ext'];
				if (file_exists($path)) break;
			}
		
		} else $path = $master->source['src'] .'/'. $master->file .'.'. $master->source['ext'];
	} else {
		if (is_array($master->source['src'])) $path = $master->source['src'][0] .'/index.php';
		else $path = $master->source['src'] .'/index.php';
	}

	if (isset ($master->source['side']))
		$page['side'] = $master->source['side'];
	if (isset ($master->source['title']))
		$page['title'] = $master->source['title'];
	if (isset ($master->source['subtitle']))
		$page['subtitle'] = $master->source['subtitle'];
	if (isset ($master->source['keyword']))
		$page['keyword'] = $master->source['keyword'] .' '. $master->file;
	if (isset ($master->source['download']))
		$related['download'] = true;

	if (file_exists($path))
		require_once ($path);
	else
		require_once ('error404.php');
	
	$context = array ();

	require_once ($tmpl .'/pager.php');
	die ();

?>
