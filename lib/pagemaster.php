<?php

class PageMaster {

	public $debug;    // Debug flag
	public $bounce;   // Character name flag
	public $download; // Download flag
	public $flags;

	public $category;
	public $file;
	public $side;

	public $loco;

	private $request;
	private $section;

	public function __construct ($loco) {
	
		$this->debug = false;
		$this->bounce = false;
		$this->download = false;
		$this->flags = array ('debug', 'bounce', 'download');

		$this->loco = $loco;
		$this->request = array ();
		$this->section = array ();
	}

	public function searchForFlag ($request) {
	
		$token = explode ('/', $request);

		foreach (array_keys($token) as $key) {
			foreach ($this->flags as $flag) {
				if ($flag == $token[$key]) {
					$this->$flag = true;
					unset ($token[$key]);
					break;
				}
			}
		}

		return implode ('/', $token);
	}

	public function searchForKeyword ($request, $category) {
	
		$match = $category->getMatch();

		if (preg_match($match, $request)) {
			$this->category = $category;
			$this->section[] = $this->category->section;
			$request = preg_replace($match, '', $request);
			if ($request) return $request;
			return 'index/';
		}

		return false;
	}

	public function searchForCatarray ($request, $cats) {

		foreach ($cats as $cat) {
			$first = $this->searchForKeyword($request, $cat);
			if ($first) {
				$this->category = $cat;
				if ($this->category->subcat) {
					$second = $this->searchForCatarray($first, $this->category->subcat);
					if ($second) return $second;
					return $first;
				}
				return $first;
			}
		}
		return false;
	}

	public function parse ($request, $categories, $default) {
	
		$this->request = $request;

		$request = $this->searchForFlag($request);
		$request = $this->searchForCatarray($request, $categories);

		if ($this->category == null)
			$this->category = new Category (
				'',
				array (),
				''
			);

		if ($request) $this->file = substr($request, 0, -1);
		else $this->file = 'index';

		if ($this->category)
			$this->side = preg_replace ('/\//', '.', $this->category->src[0]);
		else
			$this->side = '';
	}

	public function show () {
?>
		<div class="wider">
			<div class="floatleft">
				<div class="section">
					<h2>Category</h2>
					<p>
						<pre><?print_r ($this->category)?></pre>
					</p>
				</div>
			</div><div class="floatright">
				<div class="section">
					<h2>Now debugging...</h2>
					<p>Request: `<?=$this->request?>`</p>
					<p>Debug: `<?=$this->debug?>`</p>
					<p>Bounce: `<?=$this->bounce?>`</p>
					<p>Download: `<?=$this->download?>`</p>
					<p>File: `<?=$this->file?>`</p>
					<p>Side: `<?=$this->side?>`</p>
				</div><div class="section">
					<h2>Sections (<?=count($this->section)?>)</h2><ol>
					<?php foreach ($this->section as $key) echo ('<li>'.$key.'</li>'); ?>
					</ol>
				</div>
			</div>
		</div>
<?php
	}

	public function showPath () {
	
		$path = '';
		$descent = '';
		foreach ($this->section as $section) {
			$descent = $descent . preg_replace('/ /', '/', $section) .'/';
			$path = $path . $this->ilink($descent, $section, false) .' / ';
		}

		return $path;
	}

	public function mkCharBase () {
	
		$path = '';
		$descent = '';

		foreach ($this->section as $section) {
			$path = $path .'/'. preg_replace('/ /', '/', $section);
		}

		return $this->loco->base . $path .'/Personaggi/';
	}

	public function mkpath ($filename) {
	
		$filepath = '';

		while (($path = $this->category->search())) {
			
			$filepath = $path.$filename;

			if (file_exists($filepath))
				return $filepath;
		}

		return 'error404.php';
		die($filename .' has no valid path');
	}

	public function thispage () {
	
		return $this->request;
	}

	public function thisstyle () {
	
		return $this->loco->base . 'style/raw.css';
	}

	public function thisside () {
	
		return $this->loco->side . $this->side .'nav.php';
	}

	public function thiskeyword () {
	
		return implode (' ', $this->section) .' '. ($this->file?$this->file:'index');
	}
	
	public function mkcascade($title, $name, $flag=true) {

		return '<h2 id="arrow'.$title.'" class="'.($flag?'closed':'opened').'" onmousedown="javascript:cascade(\''.$title.'\')">'.$name.'</h2>'."\n";
	}

	public function mkreverse($title, $name, $flag=true) {
	
		return '<h2 id="straight'.$title.'" class="reverse '.($flag?'wider':'revwider').'" onmousedown="javascript:reverse(\''.$title.'\')">'.$name.'</h2>'."\n";
	}
	
	public function ilink ($data, $second=false, $third=false) {
		
			if (is_array($data)) {

				$url = $data['request'];
				if (isset($data['sharp']) && $data['sharp']) $url = $url .'#'. $data['sharp'];
				$title = $data['title'];

			} else {
			
				$url = $data;
				$title = $second;
				if ($third) $url = $url .'#'. $third;
			}

			if ($this->debug)
				$url = $url .'debug/';
			if ($this->bounce)
				$url = $url .'bounce/';
			if ($this->download)
				$url = $url .'download/';

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

	public function mkpage ($title, $subtitle) {
	
		$this->page = array ('title' => $title, 'subtitle' => $subtitle);
	}

	public function mkrelated ($rel, $title, $request, $sharp=false) {
	
		$this->$rel = array ('title' => $title, 'request' => $request, 'sharp' => $sharp);
	}
}

?>
