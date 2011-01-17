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
?>
