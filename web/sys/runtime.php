<?php

	$runtime['home'] = '/News/';

	$map = array (
		'diario' => array('diary'),
		'extra' => array ('extra',
			'rampa' => 'extra/rampa'),
		'legend' => array ('legend',
			'cronache' => 'legend'),
		'nanowrimo' => array ('nano',
			'corvino' => array ('nano/corvino',
				'multiColore' => 'nano/corvino'),
			'2010' => 'nano/2010',
			'2011' => 'nano/2011',
			'2012' => 'nano/2012'),
		'news' => array('news',
			'2011' => 'news/2011',
			'2012' => 'news/2012',
			'2013' => 'news/2013'),
		'recensioni' => array ('review',
			'film' => array ('review/film',
				'brutti' => 'review/brutti'),
			'libri' => 'review/book',
			'giochi' => 'review/game',
			'show' => 'review/show',
			'kamen' => array ('review/kr',
				'rider' => 'review/kr')),
		'storie' => array('str',
			'2010' => 'str/2010',
			'2011' => 'str/2011',
			'2012' => 'str/2012',
			'2013' => 'str/2013'),
		'tru' => array ('tru',
			'naluten' => array ('tru',
				'vol.I' => 'tru/primo',
				'vol.II' => 'tru/secondo',
				'vol.III' => 'tru/terzo'))
	);

?>
