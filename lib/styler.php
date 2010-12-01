<?php

	class Styler {
	
		public function parse ($url) {
		
			foreach ($this->choose as $key) {
				$match = "/($key)\//";
				if (preg_match ($match, $url)) {
					$this->style = $key;
					$url = preg_replace ($match, '', $url);
				}
			}
		
			return $url;
		}
	
		public function pilinksharp ($url, $name, $lbl) {
		
			echo $this->ilinksharp ($url, $name, $lbl);
		}
		
		public function ilinksharp ($url, $name, $lbl) {
		
			$url = preg_replace ('/(.*)\//', '$1', $url);
		
			return "<a href=\"$url/#$name\">$lbl</a>";
		}

		public function pilink ($url, $lbl) {
		
			echo $this->ilink ($url, $lbl);
		}
	
		public function ilink ($url, $lbl) {
		
			$url = preg_replace ('/(.*)\//', '$1', $url);
		
			return "<a href=\"$url/\">$lbl</a>";
		}
	}

?>
