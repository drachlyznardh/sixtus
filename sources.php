<?php
	$localbase = 'http://localhost/faiv';
	$localhome = '/News/';
	$localmatch = 'faiv';

	$sources = array (
		'Storie' => array (false,
			'2010' => 'str/2010',
			'2011' => 'str/2011'),
		'News' => array ('new',
			'2011' => 'new/2011'),
		'Recensioni' => array ('review',
			'Film' => array ('review/film',
				'Brutti' => 'review/film/brutti'),
			'Libri' => 'review/book',
			'Show' => 'review/show'),
		'Extra' => array ('extra',
			'Rampa' => 'extra/rampa'),
		'Gaem' => 'gaem',
		'NaNoWriMo' => array ('nano',
			'Corvino' => array (false,
				'MultiColore' => 'nano/corvino'),
			'2010' => 'nano/2010')
	);

	$cats = array (
		'/nanowrimo\/corvino\/multicolore\//' => 'nano/corvino/',
		'/nanowrimo\/2010\//' => 'nano/2010/',
		'/nanowrimo\//' => 'nano/',
		'/news\//' => 'new/',
		'/news\/2011\//' => 'new/2011/',
		'/storie\/2010\//' => 'str/2010/',
		'/storie\/2011\//' => 'str/2011/',
		'recensioni' => array('review',
			'film' => array ('film',
				'brutti' => 'brutti'),
			'libri' => 'book',
			'tv' => 'tv'),
		'extra' => array('extra',
			'rampa' => array('rampa')),
		'gaem' => array('gaem'),
		'test' => array('test',
			'subtest' => 'sub')
	);
?>
