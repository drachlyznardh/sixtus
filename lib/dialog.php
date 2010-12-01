<?php

	class Dialog {
	
		public $tab = "\n\t\t\t\t\t\t\t\t";
		public $bounce = false;
		public $speakers = array (
			'ci' => array ('Ci@Lyznardh&gt;$: ', ''),
			'corona' => array ('-- ', ' --')
		);
		
		public function __construct ($bounce) {
		
			$this->bounce = $bounce;
		}
		
		public function complete ($author, $humour, $speech) {
		
			$first = $this->speakers[$author][0];
			$last = $this->speakers[$author][1];

			$class = $author;
			if ($humour != '') $class = "$class $humour";
			
			if ($this->show)
				echo "$tab<p><a class=\"author\" href=\"Tru/Naluten/Personaggi/#$author\">$author</a>: <span class=\"$class\">&laquo;$first$speech$last&raquo;</span></p>\n";
			else
				echo "$tab<p class=\"$class\">&laquo;$first$speech$last&raquo;</p>\n";
		}

		public function t ($meaning, $original) {
		
			return "<span class=\"em\" title=\"che significa: &laquo;$meaning&raquo;\">$original</span>";
		}
		
		public function shout ($author, $speech) {
		
			$this->complete ($author, 'forte', $speech);
		}
		
		public function speak ($author, $speech) {
		
			$this->complete ($author, '', $speech);
		}
		
		public function inline ($author, $speech) {
		
			$first = $this->speakers[$author][0];
			$last = $this->speakers[$author][1];

			echo ("<span class=\"$author\">&laquo;$first$speech$last&raquo;</span>");
		}
	}

?>
