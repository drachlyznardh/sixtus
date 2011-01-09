<?php

	class Loco {
	
		public $whereAmI;

		public $site;
		public $base;
		public $local;
		public $tmpl;
		public $side;
		public $lib;

		public function __construct ($whereAmI, $site, $base, $local=false) {
		
			$this->whereAmI = $whereAmI;

			$this->site  = $site;
			$this->base  = $base;
			$this->local = $local;

			$this->tmpl = $site .'tmpl/';
			$this->side = $this->tmpl .'side/';
			$this->lib  = $site .'lib/';
		}

		public function mktmpl ($tmpl) {
		
			return $this->tmpl . $tmpl .'.php';
		}

		public function mklib ($lib) {
		
			return $this->lib . $lib .'.php';
		}

		public function mkstyle ($style, $ext=false) {
		
			if ($ext)
				if ($ext == 'img')
					return $this->style .'img/'. $style .'.png';
				else if ($ext == 'ico')
					return $this->style .'ico/'. $style .'.ico';
			
			return $this->style . $style .'.css';
		}

		public function mkdefault () {
		
			if ($this->whereAmI == 'localhost') return 'Storie/';
			else if ($this->whereAmI == '99k.org') return 'Tru/Naluten/';
			else if ($this->whereAmI == 'altervista') return 'Storie/';

			return $categories['Storie'];
		}
	}

	/* Set up configuration */
	$servername = $_SERVER['SERVER_NAME'];
	
	/* Set Admin data */
	$admin['name'] = 'simak';
	$admin['password'] = '020eb5a55e7b0512016dd9e182312438';

	if ($servername == 'localhost')
		$loco = new Loco ('localhost', '/opt/lampp/htdocs/faiv/', 'http://localhost/faiv', true);
	else if ($servername == 'trunaluten.99k.org')
		$loco = new Loco ('99k.org', './', 'http://trunaluten.99k.org');
	else if ($servername == 'drachlyznardh.altervista.org')
		$loco = new Loco ('altervista', './', 'http://drachlyznardh.altervista.org');

	$request = $_SERVER['REQUEST_URI'];
	if (preg_match ('/\/(.*)/', $request)) $request = preg_replace ('/\/(.*)/', '$1', $request);
	if (preg_match ('/faiv\//', $request)) $request = preg_replace ('/faiv\/(.*)/', '$1', $request);
	if ($request == '') header ('Location: ' . $loco->mkdefault());

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

	require_once ($loco->mklib('pagemaster'));
	require_once ($loco->mklib('dialog'));

	require_once ('sources.php');

	$m = new PageMaster ($loco);
	$m->parse($request, $categories, $loco->mkdefault($categories));

	if ($m->download) {
		 
		$path = $m->mkpath($m->file .'.'. $m->category->down['ext']);

		header ('Content-Type: '. $m->category->down['mime']);
		header ('Content-Disposition: attachment; filename='. $m->file .'.'. $m->category->down['ext']);
		
		$file = fopen ($path, 'r');

		if ($file) {
			while (!feof($file)) print(fread($file, 1024*1024));
			fclose ($file);
			die ();
		} else $m->mkNotFound();
	}

	$d = new Dialog($m->bounce);

	if ($m->file) {
		$path = $m->mkpath($m->file .'.php');
	} else {
		$path = $m->mkpath('index.php');
	}

	require_once ($path);
	require_once ($loco->mktmpl('pager'));
	die ();

?>
