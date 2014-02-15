<?php

	function fail ($message, $file, $line)
	{
		printf("Error: %s, in %2 @%04d\n", $message, $file, $line);
		exit(1);
	}

	function output_on_file ($target, $srcfile, $content)
	{
		$i = 0;
		printf("#### file %s\n", $target);
		foreach ($srcfile as $_) printf("%d %s\n", $i++, $_);
		printf("####\n");
		foreach($content as $_) printf("%d %04d %s\n", 0, $_[1], $_[2]);
	}

	class Splitter {

		private $meta;
		private $body;
		private $ghost;
		private $side;

		private $state;
		private $sourcefile;

		public __construct ()
		{
			$this->meta  = array();
			$this->body  = array();
			$this->ghost = array();
			$this->side  = array();
		}

		public function parse ($target)
		{

			$this->state = 'meta';
			$current = &$meta;
			$sourcefile = $target;

			$row = file($sourcefile);
			
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
