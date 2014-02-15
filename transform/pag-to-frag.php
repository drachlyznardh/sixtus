<?php

	function fail ($message, $file, $line)
	{
		printf("Error: %s, in %2 @%04d\n", $message, $file, $line);
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

	function output_on_file ($target, $sourcefile, $content)
	{
		$i = 0;
		
		$current = basename($target);
		$page = basename(dirname($target));
		$location = dirname(dirname($target));
		
		$out[] = sprintf("#### file %s %s %s\n", $location, $page, $current);
		foreach ($sourcefile as $_) $out[] = sprintf("%d %s\n", $i++, $_);
		$out[] = sprintf("####\n");
		foreach($content as $_) $out[] = sprintf("%d %04d %s\n", $_[0], $_[1], $_[2]);

		printf("Now writing %s\n", $target);
		if (file_put_contents($target, $out) === false)
			printf("Something went wrong\n");
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
			$this->body  = array();
			$this->ghost = array();
			$this->side  = array();
		}

		private function parse ($target, $indir)
		{
			array_push($this->parsedfiles, $target);
			$fileno = count($this->parsedfiles) - 1;

			$this->state = 'meta';
			$current = &$meta;
			$sourcefile = $target;

			$row = file($sourcefile);
			
			$row = file($target);
			foreach (array_keys($row) as $lineno)
			{
				$line = trim($row[$lineno]);

				if (preg_match('/#/', $line))
				{
					$token = split('#', $line);

					switch ($token[0]) {
						case 'stop':
							break;
						case 'start':
							if ($token[1] != 'meta' && $token[1] != 'body'
								&& $token[1] != 'ghost' && $token[1] != 'side')
									fail('Unkown environment '.$token[1], $srcfile, $lineno);
							$state = $token[1];
							$current = &$$token[1];
							break;
						case 'tab':
							if ($state != 'body' && $state != 'ghost')
								fail('No tabs allowed in '.$state, $srcfile, $lineno);
							${$state}[$token[1]] = array();
							$current = &${$state}[$token[1]];
							break;
						default:
							$current[] = array(&$srcfile, $lineno, $line);
					}
				}
				else $current[] = array(&$srcfile, $lineno, $line);
			}

		}
		
		public function dump () {

			output_on_file('meta', array($srcfile), $meta);
			foreach(array_keys($body) as $_)
				output_on_file('tab-'.$_, array($srcfile), $body[$_]);
			foreach(array_keys($ghost) as $_)
				output_on_file('ghost-'.$_, array($srcfile), $ghost[$_]);
			output_on_file('side', array($srcfile), $side);
		}

		public function split ($target)
		{
			$this->parse($target);
			$this->dump();
		}
	}

	new Parser().split($argv[1]);

?>
