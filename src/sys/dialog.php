<?php

	class Dialog {
	
		public $self;
		public $speakers = array (
			'ci' => array ('Ci@Lyznardh&gt;$: ', ''),
			'corona' => array ('-- ', ' --')
		);
		private $opt;
		private $notab;

		public $tab;
		public $manypages;
		public $included;
		
		public function __construct ($opt, $self, $tab) {
	
			$this->style = strtolower($opt['style']);
			$this->mode = strtolower($opt['mode']);

			if ($opt['style'] == 'Raw') unset($opt['style']);
			if ($opt['display'] == 'Standard') unset($opt['display']);

			$this->notab = false;
			if ($opt['mode'] == 'Gods') unset($opt['mode']);
			else $this->notab = true;

			$this->opt = implode ('/', $opt);
			$this->self = $self;
			$this->tab = $tab;
			$this->manypages = false;
			$this->included = false;
		}

		public function getLinkFromParams ($args, $lineno) {
			$pos = strpos ($args[2], '@');
			if ($pos === false) $title = array($args[2]);
			else $title = explode ('@', $args[2]);

			switch (count($args)) {
				case 3: return $this->newlink($args[1], $title, null, null);
				case 4: return $this->newlink($args[1], $title, $args[3], null);
				case 5: return $this->newlink($args[1], $title, $args[3], $args[4]);
			}
		}

		public function link($request, $title, $tab=false, $sharp=false, $left=false, $right=false) {
			if (!$request) $request = $this->self;
			if ($tab)
				if ($this->notab) { $ref = $request; $sharp = strtoupper($tab); }
				else $ref = substr($request, 0, -1).'§'.strtoupper($tab).'/';
			else $ref = $request;
			if ($this->opt) $ref .= $this->opt .'/';
			if ($sharp) $ref .= '#'.ucwords($sharp);
			$result = '<a href="'.$ref.'">'.$title.'</a>';
			if ($left) $result = "$left$result";
			if ($right) $result = "$result$right";
			return $result;
			return '<a href="'.$ref.'">'.$title.'</a>';
		}

		public function newlink($request, $titles, $tab, $sharp) {
			if (!$request) $request = $this->self;
			switch(count($titles)) {
				case 1: $left = null; $title = $titles[0]; $right = null; break;
				case 2: $left = null; $title = $titles[0]; $right = $titles[1]; break;
				case 3: $left = $titles[0]; $title = $titles[1]; $right = $titles[2]; break;
			}
			if ($tab) $ref = substr($request, 0, -1).'§'.strtoupper($tab).'/';
			else $ref = $request;
			return $left.'<a href="'.$ref.'#'.$sharp.'">'.$title.'</a>'.$right;
		}

		public function mktid($title, $tab, $hash=false, $left=false, $right=false) {
	
			if ($this->notab) {
				if ($hash) return $this->link($this->self, $title, false, $hash, $left, $right);
				else return $this->link($this->self, $title, false, strtoupper($tab), $left, $right);
			}

			if ($tab && $this->tab['name'] == $tab)
				if ($hash) return $this->link($this->self, $title, $tab, $hash, $left, $right);
				else return $left.'<em>'.$title.'</em>'.$right;
			else return $this->link($this->self, $title, $tab, $hash, $left, $right);
		}

		public function newtid($title, $tab, $hash) {
			if ($this->notab) {
				if ($hash) return $this->newlink($this->self, $title, null, $hash);
				else return $this->newlink($this->self, $title, null, $tab);
			} else if ($tab && $this->tab['name'] == $tab) {
				if ($hash) return $this->newlink($this->self, $title, $tab, $hash);
				else switch (count($title)) {
					case 1: return '<em>'.$title[0].'</em>';
					case 2: return '<em>'.$title[0].'</em>'.$title[1];
					case 3: return $title[0].'<em>'.$title[1].'</em>'.$title[2];
				}
			} else return $this->newlink($this->self, $title, $tab, $hash);
		}

		public function mktab($tab) {
			echo ('<a id="'.strtoupper($tab).'"></a>');
			if ($this->notab) echo ('<br />');
			if ($this->notab || $this->tab['name'] == $tab) {
				$this->included = true;
				return true;
			}
			return false;
		}

		public function allTab() { return $this->notab; }

		public function noTabIncluded () { return !$this->included; }

		public function setTab ($tab) { $this->tab['name'] = $tab; }

		public function t ($meaning, $original) {
		
			return '<em title="che significa: “'. $meaning .'”">'. $original .'</em>';
		}

		public function inline ($speaker, $tone, $line) {

			if (isset($this->speakers[$speaker])) {
				$first = $this->speakers[$speaker][0];
				$last = $this->speakers[$speaker][1];
			} else {
				$first = '';
				$last = '';
			}

			$title = ucwords ($speaker);
			if ($tone) $class = "$tone $speaker";
			else $class = $speaker;

			return '«<span title="'.$title.'" class="'.$class.'">'. $first.$line.$last .'</span>»';
		}
		
		public function intra ($speaker, $tone, $line) {
			if ($tone) $class = "$speaker $tone";
			else $class = $speaker;
			if (isset($this->speakers[$speaker])) {
				$this->speakers[$speaker][0].$line.$this->speakers[$speaker][1];
			} else $content = $line;
			$title = ucwords($speaker);
			return "<span title=\"$title\" class=\"$class\">$content</span>";
		}

		public function speak ($speaker, $first, $second=false) {
			return '<p>'.$this->inline($speaker, $first, $second).'</p>';
		}

		public function collapseOptions ($opt) {
			$result = false;

			for ($i = 1; $i < count($opt); $i += 2) {
				$result .= ' '.$opt[$i].'="'.$opt[$i+1].'"';
			}

			return $result;
		}

		public function currentStyle () { return $this->style; }

		public function currentMode () { return $this->mode; }

		public function currentSelf () { return $this->self; }
	}
?>
