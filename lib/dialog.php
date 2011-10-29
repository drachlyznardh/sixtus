<?php

	class Dialog {
	
		public $self;
		public $speakers = array (
			'ci' => array ('Ci@Lyznardh&gt;$: ', ''),
			'corona' => array ('-- ', ' --')
		);
		private $opt;
		public $tab;
		public $tabname;
		
		public function __construct ($opt, $notab, $self, $tab, $tabname) {
		
			$this->opt = $opt;
			$this->self = $self;
			$this->notab = $notab;
			$this->tab = $tab;
			$this->tabname = $tabname;
		}

		public function link($request, $title, $sharp=false) {
			$ref = $request;
			if ($sharp) $ref = substr($ref, 0, -1).".$sharp/";
			if ($this->opt) $ref .= $this->opt .'/';
			return '<a href="'.$ref.'">'.$title.'</a>';
		}

		public function frag($request, $title, $frag) {
			$ref = substr($request, 0, -1).'.'.$frag.'/';
			if ($this->opt) $ref .= $this->opt .'/';
			return '<a href="'.$ref.'">'.$title.'</a>';
		}

		public function mktid($request, $title, $tab) {
			if ($this->tabname == $tab) return '<span class="em">'.$title.'</span>';
			else return $this->link($request, $title, strtoupper($tab));
		}

		public function mktab($tab) {
			return $this->notab || $this->tabname == $tab;
		}

		public function t ($meaning, $original) {
		
			return '<span class="em" title="che significa: “'. $meaning .'”">'. $original .'</span>';
		}

		public function inline ($author, $speech) {
		
			if (isset($this->speakers[$author])) {
				$first = $this->speakers[$author][0];
				$last = $this->speakers[$author][1];
			} else {
				$first = '';
				$last = '';
			}
			return '«<span title="'.ucwords($author).'" class="'. $author .'">'. $first.$speech.$last .'</span>»';
		}
	}

?>
