<?php

class PageMaster {

	public $debug;    // Debug flag
	public $bounce;   // Character name flag
	public $download; // Download flag
	public $flags;

	public $category;
	public $file;

	public $loco;

	public function __construct ($loco) {
	
		$this->debug = false;
		$this->bounce = false;
		$this->download = false;
		$this->flags = array ('debug', 'bounce', 'download');

		$this->loco = $loco;
	}

	public function searchForFlag ($request) {
	
		$token = explode ('/', $request);

		foreach (array_keys($token) as $key) {
			foreach ($this->flags as $flag) {
				if ($flag == $token[$key]) {
					unset ($token[$key]);
					break;
				}
			}
		}

		return implode ('/', $token);
	}

	public function searchForKeyword ($request, $category) {
	
		$token = explode('/', $request);
		$found = false;

		foreach (array_keys($token) as $key) {
			foreach ($category->cat as $cat) {
				if ($cat == $token[$key]) {
					unset ($token[$key]);
					$found = true;
					break;
				}
			}
		}

		if ($found) {
			$this->category = $category;
			return implode ('/', $token);
		}

		echo ('No match for ');
		print_r($token);
		print_r($category->cat);

		return false;
	}

	public function searchForCatarray ($request, $cats) {
		foreach ($cats as $cat) {
			$result = $this->searchForKeyword($request, $cat);
			if ($result) {
				$this->category = $cat;
				echo ('<p>Result `'.$result.'`</p>');
				print_r ($this->category->subcat);
				if (isset($this->category->subcat))
					$this->searchForCatarray($result, $this->category->subcat);
				break;
			}
		}
	}

	public function parse ($request, $categories, $default) {
	
		echo ('<p>'.$request.'</p>'."\n");
		$request = $this->searchForFlag($request);
		echo ('<p>'.$request.'</p>'."\n");
		$request = $this->searchForCatarray($request, $categories);
		echo ('<p>'.$request.'</p>'."\n");
		$this->file = $request;

		$this->show();

		return $request;
	}

	public function show () {
	
		echo '<div class="section">';
		echo '<p>Debug    : `'. $this->debug .'`</p>';
		echo '<p>Bounce   : `'. $this->bounce .'`</p>';
		echo '<p>Download : `'. $this->download .'`</p>';

		echo '<p>Source   : <pre>'; print_r ($this->category); echo '</pre></p>';
		echo '<p>File     : `'. $this->file .'`</p>';
		echo '</div>';
	}

	public function showPath () {
	
		$section = implode('/', $this->category->cat);

		if ($this->file) {
			$page = ' / '. $this->ilink ($section .'/'. $this->file, $this->file);
		} else $page = '';

		return $this->ilink($section, $section) . $page;
	}

	public function mkpath ($filename) {
	
		for ($index = 0; $index < count($this->category->src); $index++) {
		
			$filepath = $this->category->src[$index] .'/'. $filename;
			if (file_exists($filepath)) break;
		}

		if (isset($filepath))
			return $filepath;
		print_r ($this);
		print_r ($this->category);
		print_r ($this->category->src);
		die($filename .' has no valid path');
	}

	public function thispage () {
	
		return $this->category->cat .'/'. $this->file .'/';
	}

	public function thisstyle () {
	
		return $this->loco->base . 'style/raw.css';
	}

	public function thisside () {
	
		return $this->loco->side . $this->category->getSrc() .'.nav.php';
	}

	public function thiskeyword () {
	
		return $this->category->key .' '. ($this->file?$this->file:'index');
	}
	
	public function mkcascade($title, $name, $flag=true) {

		return '<h2 id="arrow'.$title.'" class="'.($flag?'closed':'opened').'" onmousedown="javascript:cascade(\''.$title.'\')">'.$name.'</h2>'."\n";
	}
	
	public function ilink ($data, $second=false, $third=false) {
		
			if (is_array($data)) {

				echo ('Data is array');print_r($data);
				$url = $data['request'];
				if (isset($data['sharp'])) $url = $url .'#'. $data['sharp'];
				$title = $data['title'];

			} else {
			
				$url = $data;
				$title = $second;
				if ($third) $url = $url .'#'. $third;
			}

			return '<a href="'. $url .'">'. $title .'</a>';
	}

	public function nnk ($data, $second=false, $third=false) {
	
		if (is_array($data)) {
		
			$data['request'] = 'http://trunaluten.99k.org/'.$data['request'];
			return ($data);
		} else {
		
			return $this->ilink('http://trunaluten.99k.org/'.$data, $second, $third);
		}

		return $this->ilink ('');
	}

	public function alter ($data, $second=false, $third=false) {
	
		if (is_array($data)) {
		
			$data['request'] = 'http://drachlyznardh.altervista.org/'.$data['request'];
			return ($data);
		} else {
		
			return $this->ilink('http://drachlyznardh.altervista.org/'.$data, $second, $third);
		}

		return $this->ilink ('');
	}
}

?>
