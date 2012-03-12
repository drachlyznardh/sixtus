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
		
		private $currentTab;
		private $isTheFirstTab;
		private $tabCond;

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
			$this->tabCond = false;
			$this->isTheFirstTab = true;
		}

		public function allTabs () { return $this->tabCond; }

		public function parse ($file) {
			$this->rows = file ($file, FILE_IGNORE_NEW_LINES);
			$lineno = 0;
			foreach ($this->rows as $line) $this->parseline (++$lineno, ($line));
		}

		private function parseline ($lineno, $line) {

			$pos = strpos($line, '#');
			
			if ($pos === 0) return; // #This is a comment
			if ($pos === false) {
				$frag = array(false, $line);
			} else $frag = split ('#', $line);
			$frag[0] = strtolower(trim($frag[0]));

			switch ($frag[0]) {
				case 'start':
					$env = strtolower($frag[1]);
					switch ($env) {
						case 'page': 
							$this->switchEnvironment(LYZ_PAGE); break;
						case 'side':
							$this->switchEnvironment(LYZ_SIDE); break;
						default: die ('Cannot START#'.$env.' @line'.$lineno);
					}
					return;
				case 'stop':
					$env = strtolower($frag[1]);
					switch($env) {
						case 'page':
						case 'side':
							$this->switchEnvironment(LYZ_META); break;
						default: die ('Cannot STOP#'.$env.' @line'.$lineno);
					}
					return;
				case 'tab':
					if ($this->isTheFirstTab) {
						$this->page[0]->setName($frag[1]);
						$this->isTheFirstTab = false;
					} else {
						$tabs = count($this->page) - 1;
						if (!$this->tabCond) {
							$this->page[$tabs]->parseLine(-1, 'sec', false);
							$this->page[$tabs]->parseLine(-1, 'tid',
							array('tid', 'Continua', $frag[1], false, '…'));
						}
						$this->page[] = new Tab ($this->d, $frag[1]);
						$this->currentTab = $this->page[$tabs+1];
					}
					return;
				case 'include':
					$filename = $frag[1];
					$partToInclude = $frag[2];

					if (strpos($frag[2], '@')) {
						$token = split ('@', $frag[2]);
						switch (count($token)) {
							case 3:
								if (strcmp('as', $token[1]) != 0)
									die ('Second token has to be “as” @'.$lineno);
								switch ($token[2]) {
									case 'content': $asContent = true; break;
									default: $asContent = false;
								}
							case 1:
								$partToInclude = $token[0];
								break;
						}
					} else $asContent = false;

					if (is_file ($filename)) $include = $filename;
					else if (is_file ("$filename.lyz")) $include = "$filename.lyz";
					else if (is_file ("$filename.php")) $include = "$filename.php";
					else die ('Cannot find ['.$filename.']!!!');
					$parser = $this->getParser($include);
					#echo ("<!-- Parser->parseLine($frag[1], $frag[2]) $include, Part[$partToInclude], As[$asContent] -->\n");
					$this->currentTab->addInclude($parser, $partToInclude, $asContent);
					return;
				case 'tabs':
					$frag[1] = strtolower($frag[1]);
					switch ($frag[1]) {
						case 'allwaysall':
							$this->tabCond = true;
							break;
					}
					return;
				case 'alltab':
					$this->tabCond = true;
					return;
			}

			if (!isset($this->page)) $this->page[] = new Tab ($this->d, false);

			switch ($this->environment) {
				case LYZ_META:
					$this->parseMeta ($lineno, $frag[0], $frag);
					break;
				case LYZ_PAGE:
				case LYZ_SIDE:
					$this->currentTab->parseLine ($lineno, $frag[0], $frag);
					break;
				default: die('parse('.$cmd.', '.$opt.'), '.$content.' @line'.$lineno);
			}
		}

		private function parseMeta ($lineno, $cmd, $frag) {
		
			switch ($cmd) {
				case '': break;
				case 'title':
					switch (count($frag)) {
						case 3: $this->meta['subtitle'] = $frag[2];
						case 2: $this->meta['title'] = $frag[1];
							break;
					}
					break;
				case 'subtitle':
					$this->meta['subtitle'] = $content; break;
				case 'prev':
					switch (count($frag)) {
						case 6: $link = $this->d->link($frag[1], $frag[2], $frag[3], $frag[4], $frag[5]); break;
						case 5: $link = $this->d->link($frag[1], $frag[2], $frag[3], $frag[4]); break;
						case 4: $link = $this->d->link($frag[1], $frag[2], $frag[3]); break;
						case 3: $link = $this->d->link($frag[1], $frag[2]); break;
						default: print_r($frag); die ('Prev, WHY U NO LINK? @line'.$lineno);
					}
					$this->meta['prev'] = $link;
					break;
				case 'next':
					switch (count($frag)) {
						case 6: $link = $this->d->link($frag[1], $frag[2], $frag[3], $frag[4], $frag[5]); break;
						case 5: $link = $this->d->link($frag[1], $frag[2], $frag[3], $frag[4]); break;
						case 4: $link = $this->d->link($frag[1], $frag[2], $frag[3]); break;
						case 3: $link = $this->d->link($frag[1], $frag[2]); break;
						default: print_r($frag); die ('Next, WHY U NO LINK? @line'.$lineno);
					}
					$this->meta['next'] = $link;
					break;
				default: die ('parseMeta: Unknown command ['.$cmd.'] @line '.$lineno);
			}
		}

		private function switchEnvironment ($new, $tabname=false) {

			switch ($new) {
				case LYZ_PAGE:
					$pos = count($this->page);
					if ($pos) $pos--;
					else $this->page[] = new Tab ($this->d, false);
					$this->currentTab = $this->page[$pos];
					break;
				case LYZ_SIDE:
					$this->currentTab = $this->side;
					break;
			}
			$this->environment = $new;
		}

		public function getTitle () { return $this->meta['title']; }
		public function getSubtitle () { return $this->meta['subtitle']; }
		public function getDefaultTab () { return $this->meta['default']; }

		public function getNext () { return $this->meta['next']; }
		public function getPrev () { return $this->meta['prev']; }

		public function getAllTabs ($as) {
			$result = false;
			foreach ($this->page as $tab) $result .= $tab->getContent($as);
			return $result;
		}

		public function getTab ($name, $as) {

			if ($name) {
				foreach ($this->page as $tab)
					if (strcmp($tab->getName(), $name) == 0)
						return $tab->getContent ($as);
			} else return $this->page[0]->getContent($as);

			return '<div class="section"><p>There is no [<em>'.$name.'</em>] tab</p></div>>';
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
			foreach (array_keys($this->page) as $key) {
				echo ("<p>$key: ");
				$this->page[$key]->show();
				echo ("</p>\n");
			}

			echo ('<h2>Side</h2><p>');
			$this->side->show();
			echo ('</p>');

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
