<?php
	class Pager {
		private $counter;
		private $settings;

		private $pages;
		private $sides;
		private $metas;

		private $d;

		public function __construct ($d) {
			$this->page = true;
			$this->side = true;
			$this->meta = true;

			$this->d = $d;

			$this->counter = -1;
			$this->settings = array ();

			$this->pages = array ();
			$this->sides = array ();
			$this->metas = array ();
		}

		public function addtitle ($title, $subtitle, $default = false) {
			$this->metas['title'] = array ($title, $subtitle, $default);
			if ($default && !$this->d->tab['name'])
				$this->d->tab['name'] = $default;
		}

		public function addnext ($request, $title, $tab = false, $hash = false) {
			$this->metas['next'] = array ($request, $title, $tab, $hash);
		}

		public function addprev ($request, $title, $tab = false, $hash = false) {
			$this->metas['prev'] = array ($request, $title, $tab, $hash);
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

		public function mkpages ($d) { foreach ($this->pages as $page) echo ($page); }

		public function mksides ($d) { foreach ($this->sides as $side) echo ($side); }

		public function addmeta () { return $this->settings[$this->counter][0]; }
		public function addpage () { return $this->settings[$this->counter][1]; }
		public function addside () { return $this->settings[$this->counter][2]; }

		public function loadmeta ($file) {
			$this->push(true, false, false);
			require ($file);
			$this->pop();
		}

		public function loadpage ($file) {
			$this->push(false, true, false);
			ob_start();
			require($file);
			$result = ob_get_contents();
			ob_end_clean();
			$this->pop();

			$this->pages[] = $result;
			return $result;
		}

		public function loadside ($file) {
			$this->push(false, false, true);
			ob_start();
			require($file);
			$result = ob_get_contents();
			ob_end_clean();
			$this->pop();

			$this->sides[] = $result;
			return $result;
		}

		private function push ($meta, $page, $side) {
			$this->counter++;
			$this->settings[$this->counter] = array ($meta, $page, $side);
		}

		private function pop () {
			unset($this->settings[$this->counter]);
			$this->counter--;
		}

		public function prepare ($file, $meta, $page, $side) {
			$this->files[] = array ($file, $meta, $page, $side);

			$this->push ($meta, $page, $side);
			if ($meta) $this->loadmeta ($file);
			$this->pop ();
		}

		public function load () {
			foreach ($this->files as $file)
				$this->doload ($file[0], $file[1], $file[2], $file[3]);
		}

		public function doload ($file, $meta, $page, $side) {
			$this->push ($meta, $page, $side);
			if ($page) $this->loadpage ($file);
			if ($side) $this->loadside ($file);
			$this->pop ();
		}

		public function show () {
			foreach ($this->files as $file) {
				echo ('<div class="inside"><p>');
				print_r ($file);
				echo ('</p></div>');
			}
		}
	}
?>