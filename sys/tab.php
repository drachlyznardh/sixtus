<?php
	class Tab {
	
		private $d;
		private $name;

		private $content;
		private $section;
		private $current;
		private $continue;

		private $isPrepared;

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

		public function prepare () {

			if ($this->isPrepared) return;
			$this->isPrepared = true;

			foreach ($this->content as $fragment) {
				if (is_object($fragment)) {
					$classname = get_class($fragment);
					switch ($classname) {
						case 'Section':
						case 'Tab':
							$fragment->prepare();
							break;
						default: die ('Tab->prepare: '.$classname.' is an unknown class…');
					}
				} else switch ($fragment[0]) {
					case 'br': break;
					case 'page':
					case 'side':
					default:
						$fragment[1]->prepare();
						break;
				}
			}
		}

		public function getContent ($as) {

			if (!$this->content) return false;

			if ($this->name) {
				$result = "\n\t<!-- Tab[$this->name] as [$as] -->";
				$result .= "\n\t".'<a id="tab.'.strtoupper($this->name).'"></a>'."\n";
			} else $result = "\n\t<!-- DefaultTab as [$as] -->\n";
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
						$result .= "\t<br />\n";
						break;
					case 'struct':
						$result .= $frag[1];
						break;
					case 'page':
						$result .= "\t<!-- Including Page, [$frag[2]] as [$as] -->";
						$result .= $frag[1]->getAllTabs($as);
						break;
					case 'side':
						$result .= "\t<!-- Including Side from [$frag[2]] as [$as] -->";
						$result .= $frag[1]->getSide($frag[2]);
						break;
					default:
						$result .= "\t<!-- Including [$frag[0]] from [$frag[2]] as [$as] -->";
						$result .= $frag[1]->getTab($frag[0], $as);
						break;
						die ('Tab: Cannot getContent of ['.$frag[0].']');
				}
			}

			if ($this->continue && !$as) {
				$frag = array('tid', 'Continua', $this->continue, false, '…');
				$newsec = new Section ($this->d);
				$newsec->parseLine(-1, $frag[0], $frag);
				$newsec->prepare();
				$result .= $newsec->getContent(false);
			}

			if ($this->name) {
				$result .= "\n\t".'<a id="tab.'.$this->name.'.bottom"></a>';
				$result .= "\n\t".'<!-- /Tab['.$this->name.'] -->'."\n";
			} else $result .= "\n\t<!-- /DefaultTab -->\n";
			return $result;
		}

		public function addContinue ($continue) { $this->continue = $continue; }

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
