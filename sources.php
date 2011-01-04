<?php
	$sources['Tru'] = array (
		'src' => array ('tru', 'tru/primo', 'tru/secondo'),
		'ext' => 'php',
		'side' => 'trun.nav.php',
		'subtitle' => '',
		'keyword' => 'Tru Naluten',
		'ignore' => array ('Naluten'),
		'styles' => array ('voices.css')
	);
	$sources['NaNoWriMo'] = array (
		'src' => 'nano',
		'ext' => 'php',
		'download' => 'pdf',
		'mime' => 'application/pdf',
		'scripts' => array ('db.js'),
		'styles' => array ('voices.css'),
		'keyword' => 'NaNoWriMo 2010',
		'side' => 'nano.nav.php'
	);
	$sources['Storie'] = array (
		'src' => 'str',
		'ext' => 'php',
		#'download' => 'pdf',
		'mime' => 'application/pdf',
		'side' => 'str.nav.php',
		'title' => 'Storie',
		'subtitle' => '',
		'keyword' => 'Storie'
	);
?>
