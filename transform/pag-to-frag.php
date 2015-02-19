<?php

	require('frag/utils.php');

	function fix_tab_title ($found)
	{
		$result = mb_strtolower($found, 'UTF-8');
		return preg_replace('/ /', '-', $result);
	}

	function find_include_file ($localdir, $sourcedir, $target)
	{
		if (is_file($target)) return $target;
		
		$tmp = sprintf('%s/%s', $localdir, $target);
		if (is_file($tmp)) return $tmp;
		
		$tmp = sprintf('%s/%s', $sourcedir, $target);
		if (is_file($tmp)) return $tmp;

		return false;
	}

	function output_on_file ($type, $id, $target, $sourcefile, $content)
	{
		if (count($content) < 1) return;
		
		$out[] = sprintf("#### %d\n", $type);
		$i = 0;
		foreach ($sourcefile as $_) $out[] = sprintf("%d %s\n", $i++, $_);
		if ($id) $out[] = sprintf("#### %s\n", mb_strtoupper($id, 'UTF-8'));
		else $out[] = sprintf("####\n");
		foreach($content as $_) $out[] = sprintf("%d %04d %s\n", $_[0], $_[1], $_[2]);

		if (file_put_contents($target, $out) === false)
		{
			printf("Could not write file %s.\n", $target);
			exit(1);
		}
	}

	class Splitter {

		private $meta;
		private $body;
		private $ghost;
		private $side;

		private $state;
		private $current;
		private $parsedfiles;

		private $tabs;

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

				list($cmd, $attr, $par) = split_line_content($line);

				switch ($cmd) {
					case '':
						$this->current[] = array($fileno, $lineno + 1, $par[0]);
						break;
					case 'stop':
						break;
					case 'start':
						if ($par[1] == 'page') $par[1] = 'body'; // h4x
						if ($par[1] != 'meta' && $par[1] != 'body'
							&& $par[1] != 'ghost' && $par[1] != 'side')
								fail("Unkown environment [$par[1]]",
									$target, $lineno + 1);
						$this->state = $par[1];
						if ($this->state != 'body' && $this->state != 'ghost')
							$this->current = &$this->{$par[1]};
						else $this->current = &$this->{$par[1]}['default'];
						break;
					case 'tab':
						if ($this->state != 'body' && $this->state != 'ghost')
							fail('No tabs allowed in '.$this->state,
								$fileno, $lineno + 1);
						$title = fix_tab_title($par[1]);
						$this->{$this->state}[$title] = array();
						$this->current = &$this->{$this->state}[$title];
						break;
					case 'include':
						$this->_include($par[1], dirname($target), $indir, $fileno, $lineno + 1);
						break;
					case 'require':
						if (strlen($par[1]) < 1)
							$line .= substr($target, strlen($indir), -4);
					default:
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

			$this->tabs = $related;
		}

		private function _include ($target, $localdir, $indir, $fileno, $lineno)
		{
			$filename = find_include_file($localdir, $indir, $target);
			
			if ($filename) $this->parse($filename, $indir);
			else fail ('Unable to locate ['.$target.']['.$filename.']', $this->parsedfiles[$fileno], $lineno);

		}

		private function dump ($outdir) {

			output_on_file(true, false, $outdir.'meta.frag', $this->parsedfiles, $this->meta);
			foreach(array_keys($this->body) as $_)
				output_on_file(false, $_, $outdir.'tab-'.$_.'.frag', $this->parsedfiles, $this->body[$_]);
			foreach(array_keys($this->ghost) as $_)
				output_on_file(false, $_, $outdir.'tab-'.$_.'.frag', $this->parsedfiles, $this->ghost[$_]);
			output_on_file(false, false, $outdir.'side.frag', $this->parsedfiles, $this->side);
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
