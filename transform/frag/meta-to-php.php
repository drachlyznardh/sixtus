<?php

	class Parser {
		
		private $title = false;
		private $short = false;
		private $subtitle = false;
		private $keywords = false;

		private $prev = false;
		private $next = false;
		private $related = array();

		private $c = array();

		public function parse ($f, $l, $s)
		{
			if (!preg_match('/#/', $s))
				fail ("No meta command in [$s]", $f, $l);

			$token = split('#', $s);
			switch($token[0]) {
				case '': break;
				case 'tag': break;
				case 'title':
					switch(count($token)){
						case 3:
							$this->subtitle = polish_line($token[2]);
						case 2:
							$this->title = polish_line($token[1]);
							$this->short = $this->title;
							break;
					}
					break;
				case 'short':
					$this->short = polish_line($token[1]);
					break;
				case 'subtitle':
					$this->subtitle = polish_line($token[1]);
					break;
				case 'keywords':
					$this->keywords = polish_line($token[1]);
					break;
				case 'prev':
					if (count($token) > 2)
						$this->prev = array($token[1], polish_line($token[2]));
					else $this->prev = $token[1];
					break;
				case 'next':
					if (count($token) > 2)
						$this->next = array($token[1], polish_line($token[2]));
					else $this->next = $token[1];
					break;
				case 'tab':
					$this->c[] = $token[1];
					break;
				case 'tabs':
					if ($token[1] == 'alwaysall')
						$this->force_all_tabs = true;
					else if (strcmp($token[1], 'all_or_one') == 0)
						$this->all_or_one = true;
					break;
				case 'include':
					$this->static_include($token, $cmd_attr);
					break;
				default:
					fail("Unknown command [$token[0]]\n", $f, $l);
			}
		}

		public function dump ($target)
		{
			$format = "\t%s['%s'] = '%s';\n";
			
			$out[] = sprintf("%s?php\n", '<');
			$out[] = sprintf($format, '$p', 'title', $this->title);
			$out[] = sprintf($format, '$p', 'short', $this->short);
			$out[] = sprintf($format, '$p', 'subtitle', $this->subtitle);
			$out[] = sprintf($format, '$p', 'keywords', $this->keywords);
			$out[] = sprintf("\n");
			$out[] = sprintf($format, '$r', 'prev', $this->prev);
			$out[] = sprintf($format, '$r', 'next', $this->next);
			$out[] = sprintf("\t%s['%s'] = array('%s');\n",
				'$r', 'rel', implode("', '", $this->related));
			$out[] = sprintf("\n");
			$out[] = sprintf("\t%s = array('%s');\n",
				'$c', implode("', '", $this->c));
			$out[] = sprintf("?%s\n", '>');
			
			file_put_contents($target, $out);
		}
	}

	$p = new Parser();
	foreach ($row as $_)
	{
		list($f, $l, $s) = check_line_format ($_, $i++);
		$p->parse($f, $l, $s);
	}

	$p->dump($argv[2]);

	exit(0);
?>
