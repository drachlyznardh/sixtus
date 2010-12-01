<?php

class PageMaster {

	public $debug;    // Debug flag
	public $bounce;   // Character name flag
	public $download; // Download flag
	public $flags;

	public $source;
	public $file;
	public $sources;

	public function __construct ($sources) {
	
		$this->debug = false;
		$this->bounce = false;
		$this->download = false;
		$this->flags = array ('debug', 'bounce', 'download');

		$this->sources = $sources;
	}

	public function parse ($request) {
	
		$tokens = explode ('/', $request);

		foreach (array_keys($tokens) as $key) {
		
			$token = $tokens[$key];
			$on = true;

			if ($on) foreach ($this->flags as $flag) {
				if ($token == $flag) {
					$this->$flag = true;
					unset ($tokens[$key]);
					$on = false;
					break;
				}
			}

			if ($on) foreach (array_keys($this->sources) as $source) {
				if ($token == $source) {
					$this->source = $this->sources[$source];
					unset ($tokens[$key]);
					$on = false;
					break;
				}
			}

		}

		$this->file = substr (implode ("/", $tokens), 0, -1);

		return $request;
	}

	public function show () {
	
		echo '<p>Debug    : '. $this->debug .'</p>';
		echo '<p>Bounce   : '. $this->bounce .'</p>';
		echo '<p>Download : '. $this->download .'</p>';

		echo '<p>Source : '; print_r ($this->source); echo '</p>';
		echo '<p>File : '. $this->file .'</p>';
	}
}

?>
