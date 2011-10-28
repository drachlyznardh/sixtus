<?php

	class Source {
		private $name;
		private $destdir;
		private $sources;

		public function __construct ($name, $data) {
			$this->name = $name;

			if (is_array($data)) {

				$this->destdir = $data[0];

				$keys = array_keys($data);
				for ($i = 1; $i < count($keys); $i++)
					$this->sources[$keys[$i]] = new Source ($keys[$i], $data[$keys[$i]]);

			} else {
				$this->destdir = $data;
				$this->sources = false;
			}
		}
		
		public function show () {
			echo ('<div class="outside">');
			echo ('<p>Source [<span class="em">'.  $this->name.'</span>], ');
			echo (($this->destdir?$this->destdir:'EMPTY') .'</p>');
			if ($this->sources) foreach ($this->sources as $source) $source->show();
			echo ('</div>');
		}

		public function getLast ($result, $tokens) {
			
			#echo ('<p style="margin:2px">Count($tokens = '. (count($tokens)) .'), ');

			if (count($tokens)) {
				$keys = array_keys($tokens);
				$result['last'] = $tokens[$keys[0]];
			} else {
				$result['last'] = 'index';
			}

			#echo ($result['last'] .'</p>');

			return $result;
		}

		public function find ($tokens, $result) {
			$keys = array_keys($tokens);
			$token = $tokens[$keys[0]];

			#echo ('<div style="border:1px solid black;margin:2px">');	
			#echo ('<p style="margin:2px">'. $this->name .', '. $token .'</p>');

			if (strtolower($this->name) == $token) {
				
				$result['category'][] = $this->name;
				$result['destdir'][] = $this->destdir;
				unset($tokens[$keys[0]]);

				#echo ('<p style="margin:2px">Category ['. $this->name .']</p>');
				if ($this->sources) {
					foreach ($this->sources as $source) {
						$subresult = $source->find($tokens, $result);
						if ($subresult) {
							$result = $subresult;
							break;
						} else {
							$result = $this->getLast($result, $tokens);
						}
					}
				} else {
					$result = $this->getLast ($result, $tokens);
				}
			} else $result = false;//$this->getLast ($result, $tokens);//false;

			#echo ('</div>');
			return $result;
		}
	}

	class Finder {

		private $sources;
		private $options;
		private $tokens;
		private $category;

		public function __construct ($sources, $options) {
			$this->options = $options;

			$this->category = array();

			foreach (array_keys($sources) as $key)
				$this->sources[$key] = new Source ($key, $sources[$key]);
		}

		public function show() {
			echo ('<h2>Sources</h2>');
			foreach($this->sources as $source) $source->show();
		}

		public function find($tokens) {
			#echo ('<p>Ricerca</p>');
			$this->tokens = $tokens;
			$result = array('destdir' => false, 'category' => array());

			foreach ($this->sources as $source) {
				$result = $source->find($tokens, $result);
				if ($result) break;
			}

			#echo ('<p>Result [ ');
			#foreach ($result['category'] as $category) echo ($category .' / ');
			#echo (' ]</p>');
			#echo ('<p>Destdir: '. $result['destdir'] .'</p>');
			#echo ('<p>Last Token: '. $result['last'] .'</p>');

			return $result;
		}
	}
?>
