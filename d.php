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

	} else /*if ($servername == ') */ {
	
		$site = '';
		$base = 'http://trunaluten.99k.org';
		$db_name = 'trunaluten_99k_pages';
		$db_user = '236153_lyznardh';
		$db_pass = 'sexsecretgod';
	}
	
	/* Load libraries */
	$tmpl = $site .'tmpl';
	$sides = $tmpl .'/side';
	$forms = $tmpl .'/form';
	$lib = $site .'lib';

	require_once ($lib . '/pagemaster.php');
	require_once ("$lib/styler.php");
	require_once ("$lib/dialog.php");
	require_once ("$lib/baser.php");
	require_once ("$lib/tabler.php");

	$b = new Baser ('localhost', $db_name, $db_user, $db_pass);
	$t = new Tabler ($b);

	session_name ('lyzid');
	session_start ();
	
	if (isset ($_POST['action'])) switch ($_POST['action']) {
	
		case 'login':
		
			$username = mysql_real_escape_string ($_POST['username']);
			$password = mysql_real_escape_string ($_POST['password']);

			if (strcmp ($username, $admin['name']) == 0)
				if (strcmp (md5 ($password), $admin['password']) == 0) {
					
				$_SESSION['username'] = $username;
				$_SESSION['perm'] = 777;
				$_SESSION['id'] = 0;
			}

			$result = $b->get_user ($username) or die ($b->error ());
			if ($result) $row = mysql_fetch_assoc ($result);
			if ($row) if (strcmp ($row['password'], md5($password)) == 0) {
			
				$_SESSION['username'] = $username;
				$_SESSION['perm'] = $row['permission'];
				$_SESSION['id'] = $row['user'];

			}
			break;

		case 'logout':
			$_SESSION = array ();
			session_destroy ();
			break;
	}

	if (isset ($_SESSION['username'])) {
	
		$user['logged'] = true;
		$user['auth'] = $_SESSION['perm'];
		$user['name'] = $_SESSION['username'];
		$user['id'] = $_SESSION['id'];

	} else {
	
		$user['logged'] = false;
		$user['auth'] = false;
		$user['name'] = 'guest';
	}
	
	/* Now everything on session has been done, I'll close it */
	session_write_close();
	
	if (isset ($_POST['action']) && $user['auth']) {
	
		switch ($_POST['action']) {

			case 'hello':
				echo ('<html><body><h1>La Morte!!!</h1><a href="' . $base . '/home/">Back</a></body></html>');
				exit (0);
			
			case 'new':
				if (!$user['auth']) break;
				
				$table = mysql_real_escape_string ($_POST['new-table']);
				$key   = mysql_real_escape_string ($_POST['new-key']);
				$input = mysql_real_escape_string ($_POST['new-input']);
				$query = "insert into `$table` (`$key`) values ('$input')";

				$b->ask ($query) or die ($b->error ());

				break;
			
			case 'update-table':
				if (!$user['auth']) break;

				$table = mysql_real_escape_string ($_POST['update-table']);
				$input = mysql_real_escape_string ($_POST['update-input']);
				$field = mysql_real_escape_string ($_POST['update-field']);
				$key   = mysql_real_escape_string ($_POST['update-key']);
				$id    = mysql_real_escape_string ($_POST['update-id']);

				$query = "update `$table` set `$field` = '$input' where `$key` = '$id'";
				
				$b->ask ($query) or die ($b->error ());

				break;

			case 'remove-table':
				if (!$user['auth']) break;
				
				$table = mysql_real_escape_string ($_POST['remove-table']);
				$key   = mysql_real_escape_string ($_POST['remove-key']);
				$input = mysql_real_escape_string ($_POST['remove-input']);
				
				$query = "delete from `$table` where `$key` = '$input' limit 1;";
				$b->ask ($query) or die ($b->error ());
				
				break;
			
			case 'comment':
			
				if (!$user['logged']) break;
				
				$cuser    = mysql_real_escape_string ($_POST['cauthor']);
				$cpage    = mysql_real_escape_string ($_POST['cpage']);
				$ccontent = mysql_real_escape_string ($_POST['ccontent']);
				$cres     = mysql_real_escape_string ($_POST['cres']) or $cres = 0;
			
				$query = "insert into `comms` (`user`, `page`, `content`, `res`) values ('$cuser', $cpage, '$ccontent', $cres)";
				$b->ask ($query) or die ($b->error ());

				break;

		}
	}

	if (isset ($_GET['uri'])) {
		$request = $_GET['uri'];
		$match = '/(.*)\.(.*)\//';
		if (preg_match ($match, $request)) {
			$location = preg_replace ($match, '$1/', $request);
			header ("location: $site/$location");
		}

	} else $request  = 'home/';
	
	$sources = array (
		'NaNoWriMo' => array (
			'src' => 'nano',
			'ext' => 'php',
			'download' => 'pdf',
			'mime' => 'application/pdf',
			'scripts' => array ('db.js'),
			'styles' => array ('voices.css')
		),
		'Storie' => array (
			'src' => 'str',
			'ext' => 'php',
			'download' => 'pdf',
			'mime' => 'application/pdf'
		)
	);

	$master = new PageMaster ($sources);
	$master->parse ($request);

	if ($master->download) {
		 
		$path = $master->source['src'] .'/'. $master->file .'.'. $master->source['download'];
		echo ('downloadan '. $path);
	
		header ('Content-Type', $master->source['mime']);
		header ('Content-Disposition: attachment; filename='. $master->file .'.'. $master->source['download']);
		
		$file = fopen ($path, 'r');
		while (!feof($file)) print(fread($file, 1024*1024));
		fclose ($file);
	
	} else {

		$s = new Styler();
		$d = new Dialog($master->bounce);

		if ($master->file)
			$path = $master->source['src'] .'/'. $master->file .'.'. $master->source['ext'];
		else
			$path = $master->source['src'] .'/index.php';
		
		require_once ($path);
		$page['permission'] = 3;
		$page['comms'] = 3;
		require_once ($tmpl .'/pager.php');
	}

	die ('Die of death');

	$s = new Styler ();
	$uri = $s->parse ($uri);
	$d = new Dialog ($s->style);
	$uri = $d->parse ($uri);

	$styles = array ();
	$scripts = array ();
	$side = false;

	$page['permission'] = 1;
	$page['comms']      = 1;

	

	/* Search for built-in requests... */
	if (preg_match ('/Tables\/(.*)/', $uri)) {
		
		$styles = array ('db.css');
		$scripts = array ('scr.js', 'db.js');
		$side = 'sys.nav.php';

		$trunc = preg_replace ('/Tables\/(.*)/', '$1', $uri);
		if (strcmp ($trunc, '') == 0) {
			
			$page['title']    = 'Tabelle';
			$page['subtitle'] = 'Un occhio alla struttura';
			$page['path']     = 'sys/tables.php';
			$page['keyword']  = 'manage tables';

		} else if (strcmp ($trunc, 'Pages/') == 0) {
			
			$page['title']    = 'Pagine';
			$page['subtitle'] = 'Le pagine del sito';
			$page['path']     = 'sys/pages.php';
			$page['keyword']  = 'manage pages';

		} else if (strcmp ($trunc, 'Requests/') == 0) {
			
			$page['title']    = 'Richieste';
			$page['subtitle'] = 'URL per accedere alle pagine';
			$page['path']     = 'sys/requests.php';
			$page['keyword']  = 'manage requests';

		} else if (strcmp ($trunc, 'Links/') == 0) {
			
			$page['title']    = 'Collegamenti';
			$page['subtitle'] = 'Per collegare le pagine';
			$page['path']     = 'sys/links.php';
			$page['keyword']  = 'manage links';

		} else if (strcmp ($trunc, 'Needs/') == 0) {
			
			$page['title']    = 'Dipendenze';
			$page['subtitle'] = 'Gruppi di appartenenza';
			$page['path']     = 'sys/needs.php';
			$page['keyword']  = 'manage needs';

		} else if (strcmp ($trunc, 'Users/') == 0) {
			
			$page['title']    = 'Utenti';
			$page['subtitle'] = 'Gli utenti registrati';
			$page['path']     = 'sys/users.php';
			$page['keyword']  = 'manage users';

		} else if (strcmp ($trunc, 'Comms/') == 0) {
			
			$page['title']    = 'Commenti';
			$page['subtitle'] = 'I commenti degli utenti';
			$page['path']     = 'sys/comms.php';
			$page['keyword']  = 'manage comments';
		}

	} else if (preg_match ('/Not\/(.*)/', $uri)) {
	
		$trunc = preg_replace ('/Not\/(.*)/', '$1', $uri);

		if (strcmp ($trunc, 'Found/') == 0) {
					
			$page['title']    = '404 Not Found';
			$page['subtitle'] = 'Documento non trovato';
			$page['path']     = 'sys/error404.php';
			$page['keyword']  = 'error 404 not found';

		} else if (strcmp ($trunc, 'Permitted/') == 0) {
			
			$page['title']    = '403 Forbidden';
			$page['subtitle'] = 'Accesso proibito';
			$page['path']     = 'sys/error403.php';
			$page['keyword']  = 'error 403 forbidden';
		
		}

	} else if (strcmp ($uri, 'Debug/') == 0) {
	
		$page['title'] = 'Debug';
		$page['subtitle'] = 'La pagina per capire che succede';
		$page['path'] = 'sys/debug.php';
		$page['keyword']  = 'debug';
	
	} else 
	
	/* Search for new-system NaNoWriMo */
	if (preg_match ('/NaNoWriMo\/(.*)\//', $uri)) {
	
		$trunc = preg_replace ('/NaNoWriMo\/(.*)\//', '$1', $uri);
		
		$page['permission'] = 3;

		$filename = 'nano/' . $trunc . '.php';
		if (file_exists ($filename)) { 

			require ($filename);

/*
			$page['title']    = 'Capitolo ' . $trunc;
			$page['subtitle'] = '';
			$page['path']     = $filename;
			$page['keyword']  = 'NaNoWrimo 2010 ' . $trunc;
			$page['comms']    = 3;

			$side = 'nano.nav.php';
*/
		} else {
					
			$page['title']    = '404 Not Found';
			$page['subtitle'] = 'Documento non trovato';
			$page['path']     = 'sys/error404.php';
			$page['keyword']  = 'error 404 not found';
		}

	} else 	{

		if (strcmp ($uri, 'home/') == 0) $uri = 'Tru/Naluten/';

		$row = $b->page_data ($uri);
		if ($row) {
			
			$page['permission'] = $row['permission'];
			$page['keyword'] = $row['keywords'];

		} else {
					
			$styles[] = 'db.css';

			$page['title']    = '404 Not Found';
			$page['subtitle'] = 'Documento non trovato';
			$page['path']     = 'sys/error404.php';
			$page['keyword']  = 'error 404 not found';

		}
	}

	switch ($page['permission']) {
	
		case 3: break;
		case 2: if ($user['logged']) break;
		case 1: if ($user['auth']) break;

		default:
			$page['title']    = '403 Forbidden';
			$page['subtitle'] = 'Accesso proibito';
			$page['path']     = 'sys/error403.php';
			$page['keyword']  = 'error 403 forbidden';
			break;
	}

	if (isset($row)) {

		$page['permission'] = $row['permission'];
		$page['id']         = $row['page'];
		$page['title']      = $row['title'];
		$page['subtitle']   = $row['subtitle'];
		$page['path']       = $row['path'];
		$page['comms']      = $row['comms'];

		if ($row['style'])  $styles  = explode (';', $row['style']);
		if ($row['script']) $scripts = explode (';', $row['script']);
		if ($row['side'])   $side    = $row['side'];

		if ($row['prev'])  $related['prev']  = mysql_fetch_assoc ($b->page_short ($row['prev']));
		if ($row['index']) $related['index'] = mysql_fetch_assoc ($b->page_short ($row['index']));
		if ($row['next'])  $related['next']  = mysql_fetch_assoc ($b->page_short ($row['next']));
	}

	require ("$tmpl/pager.php");
	
	$b->close ();
?>
