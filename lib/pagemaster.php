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
	
		if ($request == '') {
			$this->file = false;
			$this->source['src'] = '.';
			$this->source['ext'] = 'php';
			return;
		}

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

			if  ($on && isset($this->source['ignore'])) foreach ($this->source['ignore'] as $ignore) {

				if ($token == $ignore) {
					unset ($tokens[$key]);
					break;
				}
			}
		}

		switch (count($tokens)) {
			
			case 0: $this->file = 'index'; break;
			case 1: $this->file = implode ('/', $tokens); break;
			default: $this->file = substr (implode ('/', $tokens), 0, -1);
		}

		return $request;
	}

	public function show () {
	
		echo '<p>Debug    : `'. $this->debug .'`</p>';
		echo '<p>Bounce   : `'. $this->bounce .'`</p>';
		echo '<p>Download : `'. $this->download .'`</p>';

		echo '<p>Source   : `'; print_r ($this->source); echo '`</p>';
		echo '<p>File     : `'. $this->file .'`</p>';
	}
}

?>
