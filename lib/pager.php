<?php
	class Pager {
		private $page;
		private $side;

		public function __construct () {
			$this->page = false;
			$this->side = false;
		}

		public function set ($page = false, $side = false) {
			$this->page = $page;
			$this->side = $side;
		}
		
		public function mkpage() { return $this->page; }

		public function mkside() { return $this->side; }
	}
?>
