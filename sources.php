<?php

	$categories['Tru'] = new Category (
		'/Tru\/Naluten\//',
		array ('tru/', 'tru/primo/', 'tru/secondo/'),
		'Tru/Naluten/',
		'Tru Naluten'
	);
	$categories['NaNoWriMo'] = new Category (
		'/NaNoWriMo\//',
		array ('nano/'),
		'NaNoWriMo/',
		'NaNoWriMo',
		false,
		array('2010' => new Category (
			'/2010\//',
			array ('nano/2010/'),
			'2010/',
			'2010',
			array ('ext' => 'pdf',
				'mime' => 'application/pdf')),
		new Category (
			'/Corvino\/Multicolore\//',
			array('nano/corvino/'),
			'Corvino/Multicolore/',
			'Corvino Multicolore'
		))
	);
	$categories['Storie'] = new Category (
		'/Storie\//',
		array ('str/', 'str/2010/', 'str/2011/'),
		'Storie/',
		'Storie',
		false,
		array('2010' => new Category (
			'/2010\//',
			array ('str/2010/'),
			'2010/',
			'2010'
		), '2011' => new Category (
			'/2011\//',
			array ('str/2011/'),
			'2011/',
			'2011'
		))
	);
?>
