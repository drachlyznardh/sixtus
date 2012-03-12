<?php
	class Tab {
	
		private $d;
		private $name;

		private $content;
		private $section;
		private $current;

		public function __construct ($d, $name) {
			$this->d = $d;
			$this->name = $name;

			$this->content = array();
			$this->current = 0;
			$this->content[$this->current] = new Section($this->d);
		}

		public function size () {
			if ($this->content) return count($this->content);
			else return 0;
		}

		public function getName () { return $this->name; }

		public function setName ($name) { $this->name = $name; }

		public function parseLine ($lineno, $cmd, $content) {

			switch ($cmd) {
				case 'sbr':
					$this->content[++$this->current] = array ('br', false);
					$this->content[++$this->current] = new Section ($this->d);
					break;
				case 'sec':
				case 'block':
					$this->content[++$this->current] = new Section ($this->d);
					break;
				case 'struct':
					$this->content[++$this->current] = new Section ($this->d);
					break;
				default:
					$this->content[$this->current]->parseLine ($lineno, $cmd, $content);
			}
			return;
		}

		public function addInclude ($parser, $part, $asContent) {
			if ($asContent)
				$this->content[$this->current]->addInclude($parser, $part, $asContent);
			else {
				$this->content[++$this->current] = array ($part, $parser, $asContent);
				$this->content[++$this->current] = new Section ($this->d);
			}
		}

		public function getContent ($as) {

			if (!$this->content) return false;

			if ($this->name) {
				$result = "\n<!-- Tab[$this->name] as [$as] -->";
				$result .= '<a id="tab.'.strtoupper($this->name).'"></a>';
			} else $result = "\n<!-- DefaultTab as [$as] -->";
			foreach ($this->content as $frag) {
				if (is_object ($frag)) {
					$classname = get_class($frag);
					switch ($classname) {
						case 'Section':
							$result .= $frag->getContent($as);
							break;
						default: die ('Tab->getContent: '.$classname.' is an unknown class…');
					}
				} else switch ($frag[0]) {
					case 'br':
						$result .= '<br />';
						break;
					case 'struct':
						$result .= $frag[1];
						break;
					case 'page':
						$result .= "\n<!-- Including Page, [$frag[2]] as [$as] -->";
						$result .= $frag[1]->getAllTabs($as);
						break;
					case 'side':
						$result .= "\n<!-- Including Side from [$frag[2]] as [$as] -->";
						$result .= $frag[1]->getSide($frag[2]);
						break;
					default:
						$result .= "\n<!-- Including [$frag[0]] from [$frag[2]] as [$as] -->";
						$result .= $frag[1]->getTab($frag[0], $as);
						break;
						die ('Tab: Cannot getContent of ['.$frag[0].']');
				}
			}

			if ($this->name) {
				$result .= '<a id="tab.'.$this->name.'.bottom"></a>';
				$result .= '<!-- /Tab['.$this->name.'] -->'."\n";
			} else $result .= "<!-- /DefaultTab -->\n";
			return $result;
		}

		public function show () {
			echo ('Tab['.$this->name.']: ');
			if ($this->content)
				foreach ($this->content as $frag)
					if (is_object($frag)) echo (get_class($frag).', ');
					else echo ($frag[0].', ');
			else echo ('[EMPTY]');
			echo ('');
		}
	}
?>
