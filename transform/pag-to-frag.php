<?php

	function fail ($message, $file, $line)
	{
		printf("Error: %s, in %s @%04d\n", $message, $file, $line);
		exit(1);
	}

	function find_include_file ($localdir, $sourcedir, $target)
	{
		if (is_file($target)) return $target;
		
		$tmp = sprintf('%s%s', $localdir, $target);
		if (is_file($tmp)) return $tmp;
		
		$tmp = sprintf('%s%s', $sourcedir, $target);
		if (is_file($tmp)) return $tmp;

		return false;
	}

	function output_on_file ($type, $target, $sourcefile, $content)
	{
		if (count($content) < 1) return;
		
		/*
		$current = basename($target);
		$page = basename(dirname($target));
		$location = dirname(dirname($target));
		
		$out[] = sprintf("#### file %s %s %s\n", $location, $page, $current);
		*/
		
		$out[] = sprintf("#### %d\n", $type);
		$i = 0;
		foreach ($sourcefile as $_) $out[] = sprintf("%d %s\n", $i++, $_);
		$out[] = sprintf("####\n");
		foreach($content as $_) $out[] = sprintf("%d %04d %s\n", $_[0], $_[1], $_[2]);

		if (file_put_contents($target, $out) === false)
		{
			printf("Could not write file %s.\n", $target);
			exit(1);
		}
		#printf("\tFragment file %s extracted.\n", basename($target));
	}

	class Splitter {

		private $meta;
		private $body;
		private $ghost;
		private $side;

		private $state;
		private $current;
		private $parsedfiles;

		public function __construct ()
		{
			$this->meta  = array();
			$this->body  = array('default' => array());
			$this->ghost = array('default' => array());
			$this->side  = array();

			$this->state = 'meta';
			$this->current = &$this->meta;
			$this->parsedfiles = array();
		}

		private function parse ($target, $indir)
		{
			array_push($this->parsedfiles, $target);
			$fileno = count($this->parsedfiles) - 1;

			$row = file($target);
			foreach (array_keys($row) as $lineno)
			{
				$line = trim($row[$lineno]);

				if (preg_match('/#/', $line))
				{
					$token = split('#', $line);

					switch ($token[0]) {
						case '':
							break;
						case 'stop':
							break;
						case 'start':
							if ($token[1] == 'page') $token[1] = 'body'; // h4x
							if ($token[1] != 'meta' && $token[1] != 'body'
								&& $token[1] != 'ghost' && $token[1] != 'side')
									fail("Unkown environment [$token[1]]",
										$target, $lineno + 1);
							$this->state = $token[1];
							if ($this->state != 'body' && $this->state != 'ghost')
								$this->current = &$this->{$token[1]};
							else $this->current = &$this->{$token[1]}['default'];
							break;
						case 'tab':
							if ($this->state != 'body' && $this->state != 'ghost')
								fail('No tabs allowed in '.$this->state,
									$fileno, $lineno + 1);
							$this->{$this->state}[$token[1]] = array();
							$this->current = &$this->{$this->state}[$token[1]];
							break;
						case 'include':
							$this->_include($token[1], dirname($target), $indir, $fileno, $lineno + 1);
							break;
						default:
							$this->current[] = array($fileno, $lineno + 1, $line);
					}
				}
				else
				{
					$this->current[] = array($fileno, $lineno + 1, $line);
				}
			}
		}

		private function relate ()
		{
			$related = array();
			foreach (array_keys($this->body) as $_)
				if (count($this->body[$_]))
					$related[] = $_;

			foreach ($related as $_)
				$this->meta[] = array(false, false, "tab#".$_);
		}

		private function _include ($target, $localdir, $indir, $fileno, $lineno)
		{
			$filename = find_include_file($localdir, $indir, $target);
			
			if ($filename) $this->parse($filename, $indir);
			else fail ('Unable to locate '.$filename, $fileno, $lineno);

		}

		private function dump ($outdir) {

			output_on_file(true, $outdir.'meta.frag', $this->parsedfiles, $this->meta);
			foreach(array_keys($this->body) as $_)
				output_on_file(false, $outdir.'tab-'.$_.'.frag', $this->parsedfiles, $this->body[$_]);
			foreach(array_keys($this->ghost) as $_)
				output_on_file(false, $outdir.'ghost-'.$_.'.frag', $this->parsedfiles, $this->ghost[$_]);
			output_on_file(false, $outdir.'side.frag', $this->parsedfiles, $this->side);
		}

		public function split ($target, $indir, $outdir)
		{
			$this->parse($target, $indir);
			$this->relate();
			$this->dump($outdir);
		}
	}

	(new Splitter())->split($argv[1], $argv[2], $argv[3]);

?>
