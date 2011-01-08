<?php

	class Category {
	
		private $index;
		private $match;

		public $src;
		public $section;
		public $down;
		public $subcat;

		public function __construct ($match, $src, $section, $down=false, $subcat=false) {
		
			$this->index = 0;

			$this->match   = $match;
			$this->src     = $src;
			$this->section = $section;
			$this->down    = $down;
			$this->subcat  = $subcat;
		}

		public function search () {
		
			if (count($this->src) > $this->index)
				return $this->src[$this->index++];
			$this->index = 0;
			return false;
		}

		public function getMatch () {
			return $this->match;
		}

		public function getName () {
			return $this->name;
		}
	}

	$categories['Tru'] = new Category (
		'/Tru\/Naluten\//',
		array ('tru/', 'tru/primo/', 'tru/secondo/'),
		'Tru Naluten'
	);
	$categories['NaNoWriMo'] = new Category (
		'/NaNoWriMo\//',
		array ('nano/'),
		'NaNoWriMo',
		false,
		array('2010' => new Category (
			'/2010\//',
			array ('nano/2010/'),
			'2010',
			array ('ext' => 'pdf',
				'mime' => 'application/pdf')
		))
	);
	$categories['Storie'] = new Category (
		'/Storie\//',
		array ('str/', 'str/2010/', 'str/2011/'),
		'Storie',
		false,
		array('2010' => new Category (
			'/2010\//',
			array ('str/2010/'),
			'2010'
		), '2011' => new Category (
			'/2011\//',
			array ('str/2011/'),
			'2011'
		))
	);
?>
