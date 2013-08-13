<?php
	class Pager {
		private $page;
		private $side;
		private $meta;

		private $pages;
		private $sides;
		private $metas;

		public function __construct ($page, $side, $meta) {
			$this->page = $page;
			$this->side = $side;
			$this->meta = $meta;

			$this->pages = array ();
			$this->sides = array ();
			$this->metas = array ();
		}

		public function set ($page = false, $side = false, $meta = false) {
			$this->page = $page;
			$this->side = $side;
			$this->meta = $meta;
		}
		
		public function addpage ($func) { if ($this->page) $this->pages[] = $func; }

		public function addside ($func) { if ($this->side) $this->sides[] = $func; }

		public function addtitle ($title, $subtitle, $default = false) {
			if ($this->meta) $this->metas['title'] = array ($title, $subtitle, $default);
		}

		public function addnext ($request, $title, $tab = false, $hash = false) {
			if ($this->meta) $this->metas['next'] = array ($request, $title, $tab, $hash);
		}

		public function addprev ($request, $title, $tab = false, $hash = false) {
			if ($this->meta) $this->metas['prev'] = array ($request, $title, $tab, $hash);
		}

		/* ERASE ME */
		public function addmetas ($key, $value) {
			$this->metas[$key] = $value;
		}

		public function title () { return $this->metas['title'][0]; }

		public function subtitle () { return $this->metas['title'][1]; }

		public function defaulttab () { return $this->metas['title'][2]; }

		public function next () {
			if (isset($this->metas['next'])) return $this->metas['next'];
			else return false;
		}

		public function prev () {
			if (isset($this->metas['prev'])) return $this->metas['prev'];
			else return false;
		}

		public function mkpages ($d) { foreach ($this->pages as $page) $page($d); }

		public function mksides ($d) { foreach ($this->sides as $side) $side($d); }
	}
?>
