<?php
	class Parser {
		
		public function parse ($f, $l, $s)
		{}

		public function dump ($target)
		{
			$out = array();

			file_put_contents($target, $out);
		}
	}

	$p = new Parser();
	foreach ($row as $_)
	{
		list($f, $l, $s) = check_line_format($_, $i++);
		$p->parse($f, $l, $s);
	}

	$p->dump($argv[2]);

	exit(0);
?>
