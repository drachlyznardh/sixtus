<?php
	class Section {
	
		private $d;

		private $isText;
		private $isPre;
		private $content;
		private $opt;

		public function __construct ($d, $opt) {
			$this->d = $d;
			$this->opt = $opt;

			$this->isText = false;
			$this->isPre = false;
			$this->content = false;
		}

		public function isEmpty () {
			if ($this->content) return count($this->content) == 0;
			return true;
		}

		private function parseOption ($lineno, $first, $second) {
		
			$optname = false;
			$optarg = false;
			$cmd = false;

			$args = split('@', $first);
			switch (count($args)) {
				case 3: $optarg = $args[2];
				case 2: $optname = $args[1];
				case 1: $cmd = $args[0];
					break;
				default: echo ('['.count($args).']'); print_r ($args); die ('WHY U NO ParseOption? @'.$lineno);
			}
			
			if (strpos($second, '#')) list ($rcmd, $rcontent) = split ('#', $second, 2);
			else list ($rcmd, $rcontent) = array ('pre', $second);

			switch ($cmd) {
				case 'p':
				case 'li':
					$this->content .= "<$cmd $optname=\"$optarg\">";
					$this->parseLine($lineno, $rcmd, $rcontent);
					$this->content .= "</$cmd>";
					break;
				case 'stitle':
					$this->content .= "<h3 $optname=\"$optarg\">";
					$this->parseLine($lineno, $rcmd, $rcontent);
					$this->content .= "</h3>";
					break;
				default: die ('WHY U NO ParseOption? ['.$cmd.'] @'.$lineno);
			}
		}

		public function parseLine ($lineno, $cmd, $opt, $content) {

			switch ($cmd) {
				case '':
					if ($content)
						$this->content .= $this->openp().$content;
					else
						$this->content .= $this->closep();
					break;
				case 'p':
					$this->content .= $this->closeP().$this->openP();
					if (strpos($content, '#')) {
						list($rcmd, $rcontent) = split ('#', $content, 2);
						$this->parseLine ($lineno, $rcmd, $opt, $rcontent);
					} else $this->content .= $content;
					break;
				case 'li':
					$this->content .= $this->openP().'<li>';
					if (strpos($content, '#')) {
						list($rcmd, $rcontent) = split ('#', $content, 2);
						$this->parseLine ($lineno, $rcmd, $opt, $rcontent);
					} else $this->content .= $content;
					$this->content .= '</li>';
					break;
				case 'reverse':
					$this->content .= $this->closeP().'<p class="reverse">';
					$this->isText = true; break;
				case 'id':
					$this->content .= $this->closeP().'<a id="'.ucwords($content).'"></a>';
					break;
				case 'br':
					$this->content .= $this->closeP().'<br />'; break;
				case 'pre':
					$this->content .= $content; break;
				case 'title':
					$this->content .= $this->closeP().'<h2>'.$content.'</h2>'; break;
				case 'titler':
					$this->content .= $this->closeP().'<h2 class="reverse">'.$content.'</h2>'; break;
				case 'stitle':
					$this->content .= $this->closeP().'<h3>';
					if (strpos($content, '#')) {
						list($rcmd, $rcontent) = split('#', $content, 2);
						$this->parseLine($lineno, $rcmd, $opt, $rcontent);
					} else $this->content .= $content;
					$this->content .= '</h3>'; break;
				case 'link':
				case 'mklink':
					$this->content .= $this->mklink ($lineno, $content); break;
				case 'tid':
				case 'mktid':
					$this->content .= $this->mktid ($lineno, $content); break;
				case 'speak':
					$this->content .= $this->closeP().'<p>'.$this->mkinline($lineno, $content).'</p>'; break;
				case 'inline':
					$this->content .= $this->openP().$this->mkinline($lineno, $content); break;
				case 'foto':
					$this->content .= $this->closeP().$this->mkfoto($content); break;
					
				case 'begin':
					switch (strtolower($content)) {
						case 'inside':
						case 'outside':
							$this->content .= $this->closeP().'<div class="'.$content.'">'; break;
						case 'pre':
							$this->isPre = true;
							$this->content .= $this->closeP(); break;
						default: die ('Section: Unknown environment ['.$content.'] BEGIN @'.$lineno);
					}
					break;
				case 'end':
					switch (strtolower($content)) {
						case 'inside':
						case 'outside':
							$this->content .= $this->closeP().'</div>'; break;
						case 'pre':
							$this->isPre = false; break;
						default: die ('Section: Unknown environment ['.$content.'] END @'.$lineno);
					}
					break;
				case 'exec':
					$this->content .= eval($content);
					break;

				default: die ('Section: Unknown command ['.$cmd.'] @'.$lineno);
			}
			$this->content .= "\n";
		}

		private function openP() {
			if ($this->isText) return '';
			$this->isText = true;
			return '<p>';
		}

		private function closeP() {
			if (!$this->isText) return '';
			$this->isText = false;
			return '</p>'."\n";
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
			//	if ($this->opt) {
			//		for ($i; $i < count ($this->opt); $i++) die ('SECTION!!!');
			//	} 
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
