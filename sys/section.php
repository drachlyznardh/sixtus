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

		private function recursive ($lineno, $args) {
				
			if (count($args) > 2) {
				array_shift($args);
				$this->parseLine ($lineno, $args[0], $args);
			} else $this->parseLine ($lineno, false, $args);
		}

		public function parseLine ($lineno, $cmd, $args) {

			if (strpos($cmd, '@')) {
				$frag = split ('@', $cmd);
				$cmd = $frag[0];
				array_shift($frag);
			}

			switch ($cmd) {
				case '':
					if ($args[1]) {
						$this->mkText();
						if (preg_match('/^\\>.*$/', $args[1])) {
							$this->mkLine('<span class="green">'.$args[1].'</span>');
						} else {
							$this->mkLine($args[1]);
						}
					} else $this->unmkText();
					break;
				case 'p':
				case 'li':
					$this->unmkText();
					$this->mkText();
					$this->recursive($lineno, $args);
					#$this->unmkText();
					break;
				case 'reverse':
					$this->unmkText();
					$this->mkText(' class="reverse"');
					$this->isText = true;
					if ($args[1]) $this->recursive ($lineno, $args[1]);
					break;
				case 'id':
					$this->unmkText();
					$this->mkLine('<a id="'.ucwords($args[1]).'"></a>');
					break;
				case 'br':
					$this->unmkText();$this->mkline('<br />'); break;
				case 'clear':
					$this->unmkText();
					switch ($args[1]) {
						case 'both':
						case 'left':
						case 'right':
							$this->mkline('<div style="clear:'.$args[1].'"></div>');
							break;
						default:
							die ('Secton->Cannot clear ['.$args[1].']');
					}
					break;
				case 'pre':
					$this->content .= $args[1]; break;
				case 'title':
					$this->unmkText();
					$this->mkLine("<h2>$args[1]</h2>");
					break;
				case 'titler':
					$this->unmkText();$this->mkline("<h2 class=\"reverse\">$args[1]</h2>"); break;
				case 'stitle':
					$this->unmkText();
					$this->content .= '<h3>';
					$this->recursive($lineno, $args);
					$this->content .= '</h3>';
					$this->unmkText(); break;
				case 'link':
				case 'mklink':
					$this->mkText();
					$this->content .= $this->mklink ($lineno, $args)."\n"; break;
				case 'tid':
				case 'mktid':
					$this->mkText();
					$this->content .= $this->mktid ($lineno, $args)."\n"; break;
				case 'speak':
					$this->unmkText();$this->mkLine('<p>'.$this->mkinline($lineno, $args).'</p>'); break;
				case 'inline':
					$this->mkText();$this->mkLine($this->mkinline($lineno, $args)); break;
				case 'foto':
					$this->unmkText();$this->mkLine($this->mkfoto($args[1])); break;
					
				case 'begin':
					$this->mkBegin($lineno, $cmd, $args); break;
				case 'end':
					$this->mkEnd($lineno, $cmd, $args); break;
				case 'exec':
					$this->content .= eval($args[1]);
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
				case 'mini':
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
				case 'mini':
				case 'inside':
				case 'outside':
				default:
					$this->content .= "\n</p>"; break;
			}
			$this->isText = false;
		}

		private function mkline ($line) { $this->content .= $line."\n"; }

		private function mkBegin ($lineno, $cmd, $args) {
			list($env, $tag) = $this->mkOpenTag($lineno, $args[1]);
			switch ($env) {
				case 'mini':
				case 'double':
				case 'ol':
				case 'ul':
				case 'inside':
				case 'outside':
					$this->unmkText(); $this->mkline($tag); break;
				default: die ('Section->mkBegin: Unknown environment ['.$env.'] BEGIN @'.$lineno);
			}
			$this->pushEnv($env);
		}

		private function mkEnd ($lineno, $cmd, $args) {
			list($env, $tag) = $this->mkCloseTag($lineno, $args[1]);
			switch ($env) {
				case 'mini':
				case 'double':
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

		private function mkOpenTag ($lineno, $composite) {
			
			if (strpos($composite, '@')) {
				$frag = split ('@', $composite);
				$env = $frag[0];
			} else $env = $composite;

			switch ($env) {
				case 'mini':
					$result = array ($env, '<div class="mini-'.$frag[1].'">');
					break;
				case 'double':
					$result = array ($env, '<div class="doublecol">');
					break;
				case 'inside':
				case 'outside':
					$result =  array ($env, '<div class="'.$env.'">');
					break;
				case 'ol':
				case 'ul':
					$opts = false;
					if (isset($frag)) switch (count ($frag)) {
						case 5: $opts .= ' '.$frag[3].'="'.$frag[4].'"';
						case 3: $opts .= ' '.$frag[1].'="'.$frag[2].'"';
						case 1: 
							$result = array ($env, '<'.$env.' '.$opts.'>');
							break;
						default: die ('Section->mkOpenTag: cannot handle '.count($frag). ' options @'.$lineno);
					} else $result = array ($composite, "<$composite>");
					break;
				default:
					die ('Section->mkOpenTag: unknown environment ['.$env.'] @'.$lineno);
			}

			return $result;
		}

		private function mkCloseTag ($lineno, $args) {
			switch ($args) {
				case 'ol':
				case 'ul':
					return array ($args, "</$args>");
				case '':
				case 'mini':
				case 'double':
				case 'inside':
				case 'outside':
				default:
					return array ($args, '</div>');
			}
		}

		public function addInclude ($parser, $part, $asContent) {

			$this->content .= "\n\t\t<!-- Including [$part] as [$asContent] -->";

			switch ($part) {
				case 'page':
					$this->content .= $parser->getAllTabs($asContent);
					break;
				case 'side':
					$this->content .= $parser->getSide($asContent);
					break;
				default: $this->content .= $parser->getTab($part, $asContent);
			}
		}

		public function getContent ($asContent) {
			$this->unmkText();
			if ($this->content) {

				$result = "\n\t".'<!-- Section as ('.$asContent.') with ('.strlen($this->content).') chars -->';
				
				if ($asContent) {
					$result .= $this->content;
				} else {
					$result .= '<div class="section">';
					$result .= $this->content;
					$result .= '</div>'."\n";
				}

				return $result;
			} else return "\n\t<!-- Empty Section -->";
		}

		private function mktid ($lineno, $args) {
			switch (count($args)) {
				case 3: return $this->d->mktid($args[1], $args[2]);
				case 4: return $this->d->mktid($args[1], $args[2], $args[3]);
				case 5: return $this->d->mktid($args[1], $args[2], $args[3], $args[4]);
				case 6: return $this->d->mktid($args[1], $args[2], $args[3], $args[4], $args[5]);
				default: print_r ($args); die ('Y U NO MKTID? @'.$lineno);
			}
		}

		public function mklink ($lineno, $args) {
			switch (count($args)) {
				case 3: return $this->d->link($args[1], $args[2]);
				case 4: return $this->d->link($args[1], $args[2], $args[3]);
				case 5: return $this->d->link($args[1], $args[2], $args[3], $args[4]);
				case 6: return $this->d->link($args[1], $args[2], $args[3], $args[4], $args[5]);
				default: print_r ($args); die ('Y U NO LINK? @'.$lineno);
			}
		}

		private function mkinline ($lineno, $args) {
			switch (count($args)) {
				case 3: return $this->d->inline($args[1], $args[2]);
				case 4: return $this->d->inline($args[1], $args[2], $args[3]);
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
