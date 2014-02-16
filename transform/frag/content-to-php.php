<?php
	
	require_once('section.php');
	
	class Parser {
	
		private $content;
		private $current;

		public function __construct ()
		{
			$this->content = array();
			$this->current = new Section();
		}

		public function parse ($f, $l, $cmd, $attr, $par)
		{
			switch($cmd){
				case 'sec':
					$this->content[] = $this->current->getContent();
					if (isset($par[1]))
						if (strcmp($par[1], 'br') == 0)
							$this->content[] = '<div class="spacer"></div>';
						else if ($par[1]) fail("Unknown parameter [$par[1]]", $f, $l);
					$this->current = new Section();
					if (isset($attr[1])) $this->current->id = $attr[1];
					break;
				default:
					$this->current->parse($f, $l, $cmd, $attr, $par);
			}
		}

		public function close ()
		{
			if ($this->current == null) return;

			$this->content[] = $this->current->getContent();
			$this->current = null;
		}

		public function dump ($target)
		{
			$this->close();
			$out = implode("\n", $this->content);
			file_put_contents($target, $out);
		}
	}

	$p = new Parser();
	foreach ($row as $_)
	{
		list($f, $l, $s) = check_line_format($_, $i++);
		list($cmd, $attr, $par) = split_line_content($s);
		$p->parse($f, $l, $cmd, $attr, $par);
	}

	$p->dump($argv[2]);

	exit(0);
?>
