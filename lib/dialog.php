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
	
			if ($opt['style'] == 'Raw') unset($opt['style']);

			$this->notab = false;
			if ($opt['mode'] == 'Gods') unset($opt['mode']);
			else $this->notab = true;

			$this->opt = implode ('/', $opt);
			$this->self = $self;
			$this->tab = $tab;
			$this->manypages = false;
			$this->included = false;
		}

		public function link($request, $title, $tab=false, $sharp=false) {
			if ($tab && !$this->notab) $ref = substr($request, 0, -1).'§'.strtoupper($tab).'/';
			else $ref= $request;
			if ($this->opt) $ref .= $this->opt .'/';
			if ($sharp) $ref .= '#'.$sharp;
			return '<a href="'.$ref.'">'.$title.'</a>';
		}

		public function mktid($title, $tab, $hash=false) {
	
			if ($this->notab) {
				if ($hash) return $this->link($this->self, $title, false, $hash);
				else return $this->link($this->self, $title, false, strtoupper($tab));
			}

			if ($tab && $this->tab['name'] == $tab)
				if ($hash) return '<span class="em">'.$this->link($this->self, $title, $tab, $hash).'</span>';
				else return '<span class="em">'.$title.'</span>';
			else return $this->link($this->self, $title, $tab, $hash);
		}

		public function mktab($tab) {
			echo ('<a id="'.strtoupper($tab).'"></a>');
			if ($this->notab || $this->tab['name'] == $tab) {
				$this->included = true;
				return true;
			}
			return false;
		}

		public function t ($meaning, $original) {
		
			return '<span class="em" title="che significa: “'. $meaning .'”">'. $original .'</span>';
		}

		public function inline ($speaker, $line) {
		
			if (isset($this->speakers[$speaker])) {
				$first = $this->speakers[$speaker][0];
				$last = $this->speakers[$speaker][1];
			} else {
				$first = '';
				$last = '';
			}
			return '«<span title="'.ucwords($speaker).'" class="'. $speaker .'">'. $first.$line.$last .'</span>»';
		}
		
		public function speak ($speaker, $line) {
			return '<p>'.$this->inline($speaker, $line).'</p>';
		}
	}
?>
