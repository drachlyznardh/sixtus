<?php

	class Parser {
		
		private $title = false;
		private $short = false;
		private $subtitle = false;

		private $prev = false;
		private $next = false;

		public function parse ($f, $l, $s)
		{
			if (!preg_match('/#/', $s))
				fail ("No meta command in [$s]", $f, $l);

			$token = split('#', $s);
			switch($token[0]) {
				case '': break;
				case 'tag': break;
				case 'title':
			}
		}

		public function dump ()
		{
			$out[] = sprintf("%s?php\n", '<');
			$out[] = sprintf("?%s\n", '>');
			
			printf("%s", implode($out));
		}
	}

	$p = new Parser();
	foreach ($row as $_)
	{
		list($f, $l, $s) = check_line_format ($_, $i++);
		$p->parse($f, $l, $s);
	}

	$p->dump();

	exit(0);
?>
