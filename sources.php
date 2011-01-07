<?php

	class Category {
	
		public $cat;
		public $src;
		public $key;
		public $ext;
		public $down;
		public $mime;
		public $ignore;
		public $subcat;

		public function __construct ($cat, $src, $key, $ext,
		$ignore=false, $down=false, $mime=false, $subcat=false) {
		
			$this->cat    = $cat;
			$this->src    = $src;
			$this->key    = $key;
			$this->ext    = $ext;
			$this->ignore = $ignore;
			$this->down   = $down;
			$this->mime   = $mime;
			$this->subcat = $subcat;
		}

		public function getSrc ($index = 0) {
		
			return $this->src[$index];
		}
	}

	$categories['Tru'] = new Category (
		array('Tru', 'Naluten'),
		array ('tru', 'tru/primo', 'tru/secondo'),
		'Tru Naluten',
		'php',
		array ('Naluten')
	);
	$categories['NaNoWriMo'] = new Category (
		array ('NaNoWriMo'),
		array ('nano'),
		'NaNoWriMo 2010',
		'php',
		false,
		'pdf',
		'application/pdf',
		array('2010' => new Category (
			array ('2010'),
			array ('nano/2010/'),
			'Corvino Multicolore',
			'php',
			false,
			'pdf',
			'application/pdf',
			false
		))
	);
	$categories['Storie'] = new Category (
		array ('Storie'),
		array ('str'),
		'Storie',
		'php'
	);
?>
