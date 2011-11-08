<?php
	class Parser {
		
		private $d;
		private $rows;

		private $title;
		private $subtitle;
		private $prev;
		private $next;

		private $page;
		private $side;
		
		private $status;
		private $isPre;
		private $isNotText;

		public function __construct ($d) {
			$this->d = $d;

			$this->status = 0;
			$this->isPre = false;
			$this->isNotText = true;

			$this->page = false;
			$this->side = false;
		}

		public function load ($file) {
			$this->rows = file ($file, FILE_IGNORE_NEW_LINES);
		}

		public function parse () {
		
			$this->page = '<div class="small"><div class="section">'."\n";
			$this->side = '<div class="section">'."\n";
			foreach ($this->rows as $line) $this->parseline (trim($line));
			$this->page .= '</div></div>'."\n";
			$this->side .= '</div>'."\n";
		}

		private function parseline ($line) {

			if (strpos($line, '#') === 0) return;

			switch ($this->status) {
				case 0: $this->parseMeta ($line); break;
				case 1: $this->parsePage ($line); break;
				case 2: $this->parseSide ($line); break;
				default: die ('Unknown status ['.$this->status.']');
			}
		}

		private function parseMeta ($line) {
		
			if ($line === '') return;

			if (strpos($line, '#')) {
				list ($cmd, $content) = preg_split ('/\#/', $line);
				$cmd = strtolower($cmd);

				if (strcmp($cmd, 'title') == 0) {
					$this->title = $content;
				} else if (strcmp($cmd, 'subtitle') == 0) {
					$this->subtitle = $content;
				} else if (strcmp($cmd, 'start') == 0) {

					$content = strtolower($content);
					if (strcmp($content, 'content') == 0) $this->setStatus (1);
					else if (strcmp($content, 'side') == 0) $this->setStatus (2);
					else die ('(0) Unknown environment ['.$content.']');
				}
			} else die ('(0) No command in line ['.$line.']');
		}

		private function parsePage ($line) {

			if (strcmp($line, '') == 0) {
				if (!$this->isNotText) $this->page .= '</p><p>';
			} else if (preg_match('/\#/', $line)) {
				list($cmd, $content) = preg_split ('/\#/', $line, 2);

				$cmd = strtolower($cmd);

				if (strcmp($cmd, 'title') == 0)
					$this->page .= $this->setNotText().'<h2>'.$content.'</h2>';
				else if (strcmp($cmd, 'titler') == 0)
					$this->page .= $this->setNotText().'<h2 class="reverse">'.$content.'</h2>';
				else if (strcmp($cmd, 'change') == 0) {
					$this->page .= $this->setNotText().'</div><div
					class="section">';
				} else if (strcmp($cmd, 'stop') == 0) {

					$content = strtolower($content);
					if (strcmp($content, 'content') == 0) $this->setStatus (0);
					else if (strcmp($content, 'pre') == 0) $this->isPre = false;
					else $this->page .= '</div> <!-- ['.$content.'] -->';

				} else if (strcmp($cmd, 'start') == 0) {

					$content = strtolower($content);
					if (strcmp($content, 'content') == 0) {
						die ('(1) Already in Content');
					} else if (strcmp($content, 'side') == 0) {
						$this->setStatus (2);
					} else if (strcmp($content, 'pre') == 0) {
						$this->ispre = true;
					} else if (strcmp($content, 'inside') == 0) {
						$this->page .= $this->setNotText().'<div class="inside">';
					} else if (strcmp('outside', $content) == 0) {
						$this->page .= $this->setNotText().'<div class="outside">';
					} else {
						die ('(1) Unknown environment ['.$content.']');
					}
				} else if (strcmp($cmd, 'mklink') == 0) {
					$this->page .= $this->mklink ($content);
				} else if (strcmp($cmd, 'mktid') == 0) {
					$this->page .= $this->mktid ($content);
				} else if (strcmp($cmd, 'include') == 0) {
					#$this->page .= $this->setText().'Should now include ['.$content.']';
					$this->page .= $this->setText().$this->mkinclude($content);
				} else if (strcmp($cmd, 'speak') == 0) {
					$this->page .= $this->setText().'Speak('.$content.')';
				} else {
					die ('(1) Unknown command ['.$cmd.']');
				}
			} else $this->page .= $this->setText().$line;

			$this->page .= "\n";
		}

		private function parseSide ($line) {

			if (strcmp($line, '') == 0) {
				$this->side .= '</p><p>';
			} else if (preg_match('/\#/', $line)) {
				list($cmd, $content) = preg_split ('/\#/', $line, 2);

				$cmd = strtolower($cmd);

				if (strcmp($cmd, 'title') == 0) {
					$this->side .= $this->setNotText().'<h2>'.$content.'</h2>';
				} else if (strcmp($cmd, 'titler') == 0) {
					$this->side .= $this->setNotText().'<h2 class="reverse">'.$content.'</h2>';
				} else if (strcmp($cmd, 'stop') == 0) {
					$content = strtolower($content);
					if (strcmp($content, 'side') == 0) $this->setStatus (0);
					else if (strcmp($content, 'pre') == 0) $this->ispre = false;
					else $this->side .= $this->setNotText().'</div> <!-- ['.$content.'] -->';
				} else if (strcmp($cmd, 'change') == 0) {
					$this->side .= $this->setNotText().'</div><div class="section">';
				} else if (strcmp($cmd, 'start') == 0) {

					$content = strtolower($content);
					if (strcmp($content, 'content') == 0) {
						$this->setStatus (1);
					} else if (strcmp($content, 'side') == 0) {
						die ('(2) Already inside [Side]');
					} else {
						die ('(2) Unknown environment ['.$content.']');
					}

				} else if (strcmp($cmd, 'mklink') == 0) {
					$this->side .= $this->mklink ($content);
				} else if (strcmp($cmd, 'mktid') == 0) {
					$this->side .= $this->mktid ($content);
				} else if (strcmp($cmd, 'include') == 0) {
					#$this->page .= $this->setText().'Should now include ['.$content.']';
					$this->side .= $this->setText().$this->mkinclude($content);
				} else {
					die ('(2) Unknown command ['.$cmd.']');
				}
			} else {
				$this->side .= $this->setText().$line;
			}

			$this->side .= "\n";
		}

		private function setText () {
			if ($this->isNotText) {
				$this->isNotText = false;
				return '<p>';
			}
			return '';
		}

		private function setNotText () {
			if ($this->isNotText) return '';
			$this->isNotText = true;
			return '</p>';
		}

		private function setStatus ($status) {
			$this->isNotText = true;
			$this->isPre = false;
			$this->status = $status;
		}

		public function getTitle () { return $this->title; }
		public function getSubtitle () { return $this->subtitle; }

		public function getNext () { return array ('Test', 'Test', false, false); }
		public function getPrev () { return array ('Test', 'Test', false, false); }

		public function getPage () { return $this->page; }
		public function getSide () { return $this->side; }

		private function mktid ($content) {
			$args = split ('#', $content);
			switch (count($args)) {
				case 2: return $this->d->mktid($args[0], $args[1]);
				case 3: return $this->d->mktid($args[0], $args[1], $args[2]);
				case 4: return $this->d->mktid($args[0], $args[1], $args[3], $args[3]);
				default: print_r ($args); die ('Y U NO MKTID?');
			}
		}

		private function mklink ($content) {
			$args = split ('#', $content);
			switch (count($args)) {
				case 2: return $this->d->link($args[0], $args[1]);
				case 3: return $this->d->link($args[0], $args[1], $args[2]);
				case 4: return $this->d->link($args[0], $args[1], $args[2], $args[3]);
				default: print_r ($args); die ('Y U NO LINK?');
			}
		}

		private function mkinclude ($content) {
			$args = split ('#', $content);
			switch (count($args)) {
				case 2: $type = $args[1];
				case 1: $file = $args[0]; break;
				default: print_r ($args); die ('Y U NO INCLUDE?');
			}

			if (!is_file ($file)) die ('(Include) '.$file.' is not a file!');

			$rec = new Parser ($this->d);
			$rec->load ($file);
			$rec->parse ();

			if ($type) {
				$type = strtolower($type);
				if (strcmp($type, 'page') == 0) return $rec->getPage();
				else if (strcmp($type, 'side') == 0) return $rec->getSide();
				else die ('(Include) Unknown type ['.$type.']');
			} else return $rec->getPage().$rec->getSide();
		}
	}
?>
