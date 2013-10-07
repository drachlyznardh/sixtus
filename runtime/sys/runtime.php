<?php

	$runtime['home'] = '/Blog/';

	$map = array (
		'blog' => array('blog',
			'2011' => 'blog/2011',
			'2012' => 'blog/2012',
			'2013' => 'blog/2013'),
		'cronache' => 'legend',
		'diario' => 'diary',
		'extra' => array ('extra',
			'rampa' => 'extra/rampa'),
		'legend' => array ('legend',
			'cronache' => 'legend'),
		'nanowrimo' => array ('nano',
			'corvino' => array ('',
				'multicolore' => 'nano/corvino'),
			'2010' => 'nano/2010',
			'2011' => 'nano/2011'),
		'recensioni' => array ('review',
			'film' => array ('review/film',
				'brutti' => 'review/brutti'),
			'libri' => 'review/book',
			'giochi' => 'review/game',
			'show' => 'review/show',
			'kamen' => array ('',
				'rider' => 'review/kr'),
			'super' => array ('',
				'sentai' => 'review/sentai')),
		'storie' => array('str',
			'2010' => 'str/2010',
			'2011' => 'str/2011',
			'2012' => 'str/2012',
			'2013' => 'str/2013'),
		'tag' => 'tag',
		'test' => 'test',
		'tru' => array ('',
			'naluten' => array ('tru',
				'vol' => 'tru/vol',
				'vol.i' => 'tru/primo',
				'vol.ii' => 'tru/secondo',
				'vol.iii' => 'tru/terzo',
				'i' => 'tru/primo',
				'ii' => 'tru/secondo',
				'iii' => 'tru/terzo'))
	);

?>
