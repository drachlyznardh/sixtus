<?php
	class Tab {
	
		private $d;
		private $name;

		private $content;
		private $section;

		public function __construct ($d, $name) {
			$this->d = $d;
			$this->name = $name;

			$this->content = false;
			$this->section = new Section ($this->d);
		}

		public function isEmpty () {
			if ($this->content) return count($this->content) == 0;
			return true;
		}

		public function getName () {
			return $this->name;
		}

		public function parseLine ($lineno, $cmd, $opt, $content) {

			switch ($cmd) {
				case 'sbr':
					$this->content[] = array ('sec', $this->section);
					$this->content[] = array ('br', false);
					$this->section = new Section ($this->d, $opt);
					break;
				case 'sec':
					$this->content[] = array ('sec', $this->section);
					$this->section = new Section ($this->d, $opt);
					break;
				case 'struct':
					$this->content[] = array ('sec', $this->section);
					$this->content[] = array ('struct', $content);
					$this->section = new Section ($this->d, $opt);
					break;
				case 'block':
					$this->content[] = array ('sec', $this->section);
					$this->section = new Section ($this->d, $opt);
				default:
					$this->section->parseLine ($lineno, $cmd, $opt, $content);
			}
			return;
		}

		public function addInclude ($parser, $part, $as) {
			if (strcmp($as, 'content') == 0)
				$this->section->addInclude($parser, $part, $as);
			else {
				$this->close();
				$this->content[] = array ($part, $parser, $as);
			}
		}

		public function getContent ($as) {

			if (!$this->content) return false;
			$result = false;
			$result .= '<a id="'.strtoupper($this->name).'"></a>';
			foreach ($this->content as $frag) {
				switch ($frag[0]) {
					case 'sec':
						$result .= $frag[1]->getContent($as);
						break;
					case 'br':
						$result .= '<br />';
						break;
					case 'struct':
						$result .= $frag[1];
						break;
					case 'page':
						$result .= $frag[1]->getPage(false, $frag[2]);
						break;
					case 'side':
						$result .= $frag[1]->getSide($frag[2]);
						break;
					case 'both':
						$result .= 'INCLUDING['.$frag[0].']';
						break;
					default:
						$result .= $frag[1]->getTab($frag[0], $as);
						break;
						die ('Tab: Cannot getContent of ['.$frag[0].']');
				}
			}

			return $result;

			if ($this->content) {
				$result = '<!-- Tab[ --><div class="section">';
				$result .= $this->content;
				$result .= '</div> <!-- ] /Tab -->'."\n";
				return $result;
			} else return false;
		}

		public function show () {
			echo ('<p>['.$this->name.']: ');
			if ($this->content) foreach ($this->content as $frag) echo ($frag[0].', ');
			else echo ('[EMPTY]');
			echo ('</p>');
		}

		public function close () {
			if (!$this->section->isEmpty()) {
				$this->content[] = array ('sec', $this->section);
				$this->section = new Section ($this->d);
			}
		}
	}
?>
