<?php
		
	define('LYZ_META', 0);
	define('LYZ_PAGE', 1);
	define('LYZ_SIDE', 2);

	class Parser {

		private $d;
		private $rows;
		private $environment;
		private $parser;

		private $page;
		private $side;
		
		private $tab;

		public function __construct ($d) {
			$this->d = $d;
			$this->status = 0;
			$this->environment = LYZ_META;
			$this->parser = array ();
			$this->meta = array (
				'title' => false,
				'subtitle' => false,
				'default' => false,
				'prev' => false,
				'next' => false);

			$this->page = array();
			$this->side = new Tab ($this->d, false);
			$this->tab = new Tab ($this->d, false);
		}

		public function parse ($file) {
			$this->rows = file ($file, FILE_IGNORE_NEW_LINES);
			$lineno = 0;
			foreach ($this->rows as $line) $this->parseline (++$lineno, trim($line));
		}

		private function parseline ($lineno, $line) {

			$pos = strpos($line, '#');
			
			if ($pos === 0) return;
			if ($pos === false) {
				$cmd = false;
				$opt = false;
				$content = $line;
			} else {
				list ($cmd, $content) = split ('#', $line, 2);
				$cmd = strtolower($cmd);

				if (strpos($cmd, '@')) {
					list ($cmd, $opt) = split ('@', $cmd, 2);
					$opt = split('@', $opt);
				} else $opt = false;
			}

			switch ($cmd) {
				case 'start':
					$env = strtolower($content);
					switch ($env) {
						case 'page':
							$this->switchEnvironment(LYZ_PAGE); break;
						case 'side':
							$this->switchEnvironment(LYZ_SIDE); break;
						default: die ('Cannot START#'.$env.' @line'.$lineno);
					}
					return;
				case 'stop':
					$env = strtolower($content);
					switch($env) {
						case 'page':
						case 'side':
							$this->switchEnvironment(LYZ_META); break;
						default: die ('Cannot STOP#'.$env.' @line'.$lineno);
					}
					return;
				case 'tab':
					$this->tab->close();
					if ($this->environment == LYZ_PAGE) {
						if (!$this->tab->isEmpty()) $this->page[] = $this->tab;
						$this->tab = new Tab ($this->d, $content);
					} else die ('Cannot TAB#'.$content.' @line'.$lineno);
					return;
				case 'include':
					list($part, $file) = $this->getIncludeKeyword($content);
					$parser = $this->getParser($file);
					if ($opt && strcmp($opt[0], 'as') == 0) $as = $opt[1];
					else $as = false;
					$this->tab->addInclude($parser, $part, $as);
					return;
			}

			switch ($this->environment) {
				case LYZ_META:
					$this->parseMeta ($lineno, $cmd, $opt, $content);
					break;
				case LYZ_PAGE:
				case LYZ_SIDE:
					$this->tab->parseLine ($lineno, $cmd, $opt, $content);
					break;
				default: die('parse('.$cmd.', '.$opt.'), '.$content.' @line'.$lineno);
			}
		}

		private function parseMeta ($lineno, $cmd, $opt, $content) {
		
			switch ($cmd) {
				case '': break;
				case 'title':
					if (strpos($content, '#')) {
						list($title, $subtitle) = split ('#', $content);
						$this->meta['title'] = $title;
						$this->meta['subtitle'] = $subtitle;
					} else $this->meta['title'] = $content;
					break;
				case 'subtitle':
					$this->meta['subtitle'] = $content; break;
				case 'prev':
					$args = split('#', $content);
					switch (count($args)) {
						case 5: $link = $this->d->link($args[0], $args[1], $args[2], $args[3], $args[4]); break;
						case 4: $link = $this->d->link($args[0], $args[1], $args[2], $args[3]); break;
						case 3: $link = $this->d->link($args[0], $args[1], $args[2]); break;
						case 2: $link = $this->d->link($args[0], $args[1]); break;
						default: print_r($args); die ('Prev, WHY U NO LINK? @line'.$lineno);
					}
					$this->meta['prev'] = $link;
					break;
				case 'next':
					$args = split('#', $content);
					switch (count($args)) {
						case 5: $link = $this->d->link($args[0], $args[1], $args[2], $args[3], $args[4]); break;
						case 4: $link = $this->d->link($args[0], $args[1], $args[2], $args[3]); break;
						case 3: $link = $this->d->link($args[0], $args[1], $args[2]); break;
						case 2: $link = $this->d->link($args[0], $args[1]); break;
						default: print_r($args); die ('Next, WHY U NO LINK? @line'.$lineno);
					}
					$this->meta['next'] = $link;
					break;
				default: die ('parseMeta: Unknown command ['.$cmd.'] @line '.$lineno);
			}
		}

		private function switchEnvironment ($new, $tabname=false) {

			$this->tab->close();
			if (!$this->tab->isEmpty()) switch ($this->environment) {
				case LYZ_PAGE:
					$this->page[] = $this->tab;
					$this->tab = new Tab($this->d, $tabname);
					break;
				case LYZ_SIDE:
					$this->side = $this->tab;
					$this->tab = new Tab($this->d, false);
					break;
			}
			$this->environment = $new;
		}

		public function getTitle () { return $this->meta['title']; }
		public function getSubtitle () { return $this->meta['subtitle']; }
		public function getDefaultTab () { return $this->meta['default']; }

		public function getNext () { return $this->meta['next']; }
		public function getPrev () { return $this->meta['prev']; }

		public function getPage ($name, $as) {

			$page = false;

			if (!$name) return $this->page[0]->getContent($as);

			if (strcmp($name, 'all') == 0) {
				foreach ($this->page as $tab)
					$page .= $tab->getContent($as);
				return $page;
			}

			foreach ($this->page as $tab)
				if (strcmp($tab->getName(), $name) == 0)
					return $tab->getContent($as);

			return '<div class="section"><p>There is no tab ['.$name.']</p></div>';
		}

		public function getSide ($as) {
			return $this->side->getContent($as);
		}

		private function getParser ($file) {

			if (!isset($this->parser[$file])) {
				$parser = new Parser($this->d);
				$this->parser[$file] = $parser;
				$parser->parse($file);
			}
			return $this->parser[$file];
		}

		private function getIncludeKeyword ($content) {
			if (strpos($content, '#')) {
				list ($file, $keyword) = split ('#', $content);
			} else {
				$file = $content;
				$keyword = 'both';
			}

			if (is_file ($file)) $include = $file;
			else if (is_file ("$file.lyz")) $include = "$file.lyz";
			else if (is_file ("$file.php")) $include = "$file.php";
			else die ('Cannot include ['.$file.']!!!');

			return array ($keyword, $include);
		}

		public function show () {

			echo ('<h2>Page / Tabs ('.count($this->page).')</h2>');
			foreach ($this->page as $tab) $tab->show();

			echo ('<h2>Side</h2>');
			$this->side->show();

			echo ('<h2>Include ('.count($this->parser).')</h2>');
			foreach ($this->parser as $parser) {
				echo ('<div style="width:50%;float:left"><div class="section">');
				$parser->show();
				echo ('</div></div>');
			}
			echo ('<div style="clear:both">');
			echo ('</div>');
		}
	}
?>
