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
		private $ct = false;

		public function parse ($f, $l, $cmd, $attr, $par)
		{
			switch($cmd) {
				case '': break;
				case 'tag': break;
				case 'title':
					switch(count($par)){
						case 3:
							$this->subtitle = polish_line($par[2]);
						case 2:
							$this->title = polish_line($par[1]);
							$this->short = $this->title;
							break;
					}
					break;
				case 'short':
					$this->short = polish_line($par[1]);
					break;
				case 'subtitle':
					$this->subtitle = polish_line($par[1]);
					break;
				case 'keywords':
					$this->keywords = polish_line($par[1]);
					break;
				case 'prev':
					if (count($par) > 2)
						$this->prev = array($par[1], polish_line($par[2]));
					else $this->prev = $par[1];
					break;
				case 'next':
					if (count($par) > 2)
						$this->next = array($par[1], polish_line($par[2]));
					else $this->next = $par[1];
					break;
				case 'related':
					$this->related[] = $par[1];
					break;
				case 'tab':
					$this->c[] = $par[1];
					break;
				case 'tabs':
					if ($par[1] == 'alwaysall')
						$this->ct = true;
					else if (strcmp($par[1], 'all_or_one') == 0)
						$this->ct = true;
					break;
				default:
					fail("[Meta-2-PHP] Unknown command [$par[0]]\n", $f, $l);
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
			if (is_array($this->prev))
				$out[] = sprintf("\t%s['%s'] = array('%s');\n",
					'$r', 'prev', implode("', '", $this->prev));
			else $out[] = sprintf($format, '$r', 'prev', $this->prev);
			if (is_array($this->next))
				$out[] = sprintf("\t%s['%s'] = array('%s');\n",
					'$r', 'next', implode("', '", $this->next));
			else $out[] = sprintf($format, '$r', 'next', $this->next);
			$out[] = sprintf("\t%s['%s'] = array('%s');\n",
				'$r', 'rel', implode("', '", $this->related));
			$out[] = sprintf("\n");
			$out[] = sprintf("\t%s = array('%s');\n",
				'$c', implode("', '", $this->c));
			$out[] = sprintf("\t%s = %s;\n", '$ct', $this->ct?'true':'false');
			$out[] = sprintf("?%s\n", '>');
			
			file_put_contents($target, $out);
		}
	}

	$p = new Parser();
	foreach ($row as $_)
	{
		list($f, $l, $s) = check_line_format ($_, $i++);
		list($cmd, $attr, $par) = split_line_content($s);
		$p->parse($filenames[$f], $l, $cmd, $attr, $par);
	}

	$p->dump($argv[2]);

	exit(0);
?>
