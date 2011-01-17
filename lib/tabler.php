<?php

	class Tabler {

		private $d;
		private $m;
		private $chapter;
		private $root;

		public function __construct ($d, $m, $chapter, $root) {
			$this->d = $d;
			$this->m = $m;
			$this->chapter = $chapter;
			$this->root = $root;
		}

		public function mktab($number, $title, $file, $next=false) {
		
			$m = $this->m;
			$d = $this->d;
		
			echo ("\n".'<div class="tab" id="tab'.$number.'" style="display: none">');
			echo ("\n\t".'<div class="section"><a id="'.$number.'"></a>');
			echo ("\n\t\t".'<h2>'.$this->chapter.', '.$number.' &ndash; '.$title.'</h2>');
			require_once ($this->root . $file);
			echo ("\n\t\t".'<h2 class="reverse">'.$this->chapter.', '.$number.' &ndash; '.$title.' /fine</h2>');
			if ($next)
				echo ("\n\t\t".'<p>Salta alla <a
				onclick="javascript:tab.show(\''.$next.'\', true)">prossima
				sezione</a>.</p>');
			echo ("\n\t".'</div>');
			echo ("\n".'</div>');

		}

		public function mkli($title, $number) {
		
			echo ("\t\t\t\t\t");
			echo ('<li class="reverse" id="tarrow'.$number.'"><a onclick="javascript:tab.show(\''.$number.'\', true)">');
			echo ($title.'</a></li>');
			echo ("\n");
		}
	}
?>
