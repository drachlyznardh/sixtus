<?php

	class Dialog {
	
		public $tab = "\n\t\t\t\t\t\t\t\t";
		public $bounce = false;
		public $speakers = array (
			'ci' => array ('Ci@Lyznardh&gt;$: ', ''),
			'corona' => array ('-- ', ' --')
		);
		private $opt;
		private $complete;
		
		public function __construct ($bounce, $base, $opt) {
		
			$this->bounce = $bounce;
			$this->base = $base.'Personaggi/';
			$this->opt = implode ('/',$opt);
			$this->complete = isset($opt['complete']);
		}
		
		public function isComplete() {
			return $this->complete;
		}

		public function link($request, $title, $sharp=false) {
			$ref = $request;
			if ($sharp) $ref .= '#'.$sharp;
			if ($this->opt) $ref .= $this->opt;
			return '<a href="'.$ref.'">'.$title.'</a>';
		}

		public function complete ($author, $humour, $speech) {
		
			if(!$author) $author = 'unknown';

			if (isset($this->speakers[$author])) {
				$first = $this->speakers[$author][0];
				$last = $this->speakers[$author][1];
			} else {
				$first = '';
				$last = '';
			}

			$class = $author;
			if ($humour != '') $class = "$class $humour";
			
			if ($this->bounce)
				echo "$this->tab<p><a class=\"author\"
				href=\"$this->base#$author\">$author</a>: <span class=\"$class\">&laquo;$first$speech$last&raquo;</span></p>\n";
			else
				echo "$this->tab<p class=\"$class\">&laquo;$first$speech$last&raquo;</p>\n";
		}

		public function t ($meaning, $original) {
		
			return "<span class=\"em\" title=\"che significa: &laquo;$meaning&raquo;\">$original</span>";
		}

		public function legend ($author) {
			return '<a class="legend" href="'.$this->base.'#'.$author.'">'.$author.'</a>';
		}
		
		public function shout ($author, $speech) {
		
			$this->complete ($author, 'forte', $speech);
		}
		
		public function speak ($author, $speech) {
		
			$this->complete ($author, '', $speech);
		}
		
		public function inline ($author, $speech) {
		
			if(!$author) $author = 'unknown';

			if (isset($this->speakers[$author])) {
				$first = $this->speakers[$author][0];
				$last = $this->speakers[$author][1];
			} else {
				$first = '';
				$last = '';
			}

			echo ("<span class=\"$author\">&laquo;$first$speech$last&raquo;</span>");
		}
	}

?>
