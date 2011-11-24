<?php
	class Section {
	
		private $d;

		private $isText;
		private $isPre;
		private $content;
		private $opt;
		
		private $stack;
		private $counter;

		public function __construct ($d) {
			$this->d = $d;

			$this->isText = false;
			$this->isPre = false;
			$this->content = false;

			$this->stack = array (false);
			$this->counter = 0;
		}

		public function isEmpty () {
			if ($this->content) return count($this->content) == 0;
			return true;
		}

		private function recursive ($lineno, $content) {
			if (strpos($content, '#')) {
				list($rcmd, $rcontent) = split ('#', $content, 2);
				if (strpos($rcmd, '@')) {
					$opt = split ('@', $content);
					$this->parseLine ($lineno, $opt[0], $opt, $rcontent);
				} else $this->parseLine ($lineno, $rcmd, false, $rcontent);
			} else $this->mkLine($content);
		}

		public function parseLine ($lineno, $cmd, $opt, $content) {

			switch ($cmd) {
				case '':
					if ($content) {
						$this->mkText();
						$this->mkLine($content);
					} else $this->unmkText();
					break;
				case 'p':
					$this->mkText();
					$this->recursive($lineno, $content);
					break;
				case 'li':
					$this->mkText($opt);
					$this->recursive($lineno, $content);
					$this->unmkText();
					break;
				case 'reverse':
					$this->unmkText();
					$this->mkText(' class="reverse"');
					$this->isText = true;
					if ($content) $this->recursive ($lineno, $content);
					break;
				case 'id':
					$this->unmkText();
					$this->mkLine('<a id="'.ucwords($content).'"></a>');
					break;
				case 'br':
					$this->unmkText();$this->mkline('<br />'); break;
				case 'pre':
					$this->content .= $content; break;
				case 'title':
					$this->unmkText();
					$this->mkLine("<h2>$content</h2>");
					break;
				case 'titler':
					$this->unmkText();$this->mkline("<h2 class=\"reverse\">$content</h2>"); break;
				case 'stitle':
					$this->unmkText();
					$this->content .= '<h3>';
					$this->recursive($lineno, $content);
					$this->content .= '</h3>'; break;
				case 'link':
				case 'mklink':
					$this->mkText();
					$this->content .= $this->mklink ($lineno, $content)."\n"; break;
				case 'tid':
				case 'mktid':
					$this->mkText();
					$this->content .= $this->mktid ($lineno, $content)."\n"; break;
				case 'speak':
					$this->unmkText();$this->mkLine('<p>'.$this->mkinline($lineno, $content).'</p>'); break;
				case 'inline':
					$this->mkText();$this->mkLine($this->mkinline($lineno, $content)); break;
				case 'foto':
					$this->unmkText();$this->mkLine($this->mkfoto($content)); break;
					
				case 'begin':
					$this->mkBegin($lineno, $cmd, $opt, $content);break;
				case 'end':
					$this->mkEnd($lineno, $cmd, $opt, $content); break;
				case 'exec':
					$this->content .= eval($content);
					break;

				default: die ('Section: Unknown command ['.$cmd.'] @'.$lineno);
			}
		}

		private function pushEnv ($env) { $this->stack[++$this->counter] = $env; }

		private function popEnv () { $this->counter--; }

		private function currentEnv () { return $this->stack[$this->counter]; }

		private function mkText ($opt=false) {
			if (!$this->isText) switch ($this->currentEnv()) {
				case 'ol':
				case 'ul':
					if ($opt) $this->content .= "<li $opt>\n";
					else $this->content .= "<li>\n"; break;	
				case '':
				case 'inside':
				case 'outside':
					if ($opt) $this->content .= "<p $opt>";
					else $this->content .= "<p>\n"; break;
			}
			$this->isText = true;
		}

		private function unmkText () {
			if ($this->isText) switch ($this->currentEnv()) {
				case 'ol':
				case 'ul':
					$this->content .= "\n</li>"; break;
				case '':
				case 'inside':
				case 'outside':
					$this->content .= "\n</p>"; break;
			}
			$this->isText = false;
		}

		private function mkline ($line) { $this->content .= $line."\n"; }

		private function mkBegin ($lineno, $cmd, $opt, $content) {
			list($env, $tag) = $this->mkOpenTag($lineno, $content);
			switch ($env) {
				case 'ol':
				case 'ul':
				case 'inside':
				case 'outside':
					$this->unmkText(); $this->mkline($tag); break;
				case 'pre':
					$this->isPre = true;
					$this->content .= $this->closeP(); break;
				default: die ('Section->mkBegin: Unknown environment ['.$env.'] BEGIN @'.$lineno);
			}
			$this->pushEnv($env);
		}

		private function mkEnd ($lineno, $cmd, $opt, $content) {
			list($env, $tag) = $this->mkCloseTag($lineno, $content);
			switch ($env) {
				case 'ol':
				case 'ul':
				case 'inside':
				case 'outside':
					$current = $this->currentEnv();
					if (strcmp($env, $current) == 0) {
						$this->unmkText();
						$this->mkline($tag);
					} else die ("Cannot close $env before $current @$lineno");
					break;
				default: die ("Section->mkEnd: Unknown environment [$env] @$lineno");
			}
			$this->popEnv();	
		}

		private function mkOpenTag ($lineno, $token) {
			if (strpos($token, '@')) {
				$args = split ('@', $token);
				$env = $args[0];
				$opt = $args;
			} else {
				$env = $token;
				$opt = false;
			}
			
			switch ($env) {
				case 'inside':
				case 'outside':
					$result =  array ($env, '<div class="'.$env.'">');
					break;
				case 'ol':
				case 'ul':
					$opts = false;
					if ($opt) switch (count ($opt)) {
						case 5: $opts .= ' '.$opt[3].'="'.$opt[4].'"';
						case 3: $opts .= ' '.$opt[1].'="'.$opt[2].'"';
						case 1: 
							$result = array ($env, '<'.$env.' '.$opts.'>');
							break;
						default: die ('Section->mkOpenTag: cannot handle '.count($opt). ' options @'.$lineno);
					} else $result = array ($token, "<$token>");
					break;
				default:
					die ('Section->mkOpenTag: unknown environment ['.$env.'] @'.$lineno);
			}

			//$this->setEnvironment($env);
			return $result;
		}

		private function mkCloseTag ($lineno, $token) {
			switch ($token) {
				case 'ol':
				case 'ul':
					return array ($token, "</$token>");
				case '':
				case 'inside':
				case 'outside':
					return array ($token, '</div>');
			}
		}

		public function addInclude ($parser, $part, $as) {
			switch ($part) {
				case 'page':
					$this->content .= $parser->getPage(false, $as);
					break;
				case 'side':
					$this->content .= $parser->getSide($as);
					break;
				default: $this->content .= $parser->getPage($part, $as);
			}
		}

		public function getContent ($as) {
			if ($this->content) {
				if ($as && strcmp($as, 'content') == 0) return $this->content;

				$result = false;
				$result .= '<!-- Section[as('.$as.') --><div class="section"';
				$result .= '>';
				$result .= $this->content;
				$result .= '</div> <!-- ] /Section -->'."\n";
				return $result;
			} else return false;
		}

		private function mktid ($lineno, $content) {
			$args = split ('#', $content);
			switch (count($args)) {
				case 2: return $this->d->mktid($args[0], $args[1]);
				case 3: return $this->d->mktid($args[0], $args[1], $args[2]);
				case 4: return $this->d->mktid($args[0], $args[1], $args[2], $args[3]);
				case 5: return $this->d->mktid($args[0], $args[1], $args[2], $args[3], $args[4]);
				default: print_r ($args); die ('Y U NO MKTID? @'.$lineno);
			}
		}

		public function mklink ($lineno, $content) {
			$args = split ('#', $content);
			switch (count($args)) {
				case 2: return $this->d->link($args[0], $args[1]);
				case 3: return $this->d->link($args[0], $args[1], $args[2]);
				case 4: return $this->d->link($args[0], $args[1], $args[2], $args[3]);
				case 5: return $this->d->link($args[0], $args[1], $args[2], $args[3], $args[4]);
				default: print_r ($args); die ('Y U NO LINK? @'.$lineno);
			}
		}

		private function mkinline ($lineno, $content) {
			$args = split ('#', $content);
			switch (count($args)) {
				case 2: return $this->d->inline($args[0], $args[1]);
				case 3: return $this->d->inline($args[0], $args[1], $args[2]);
				default: print_r ($args); die ('Y U NO INLINE? @'.$lineno);
			}
		}
					
		private function mkfoto ($content) {
			$args = split ('#', $content);
			$ref = $args[0];
			if (count($args) > 1) $src = $args[1];
			else $src = $args[0];
			$this->content .= '<p class="foto"><a target="_blank" href="'.$ref.'">';
			$this->content .= '<img src="'.$src.'" />';
			$this->content .= '</a>';
		}
	}
?>
