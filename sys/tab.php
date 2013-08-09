<?php
	class Tab
	{
		private $content;
		private $current;
		private $name;

		public function __construct()
		{
			$this->current = null;
			$this->content = array();
		}

		public function parse($index, $cmd, $cmd_attr, $cmd_args)
		{
			switch($cmd)
			{
				case 'sbr':
					$this->content[] = $this->current->getContent();
					$this->content[] = '<br />';
					$this->current = new Section();
					break;
				case 'sec':
					$this->content[] = $this->current->getContent();
					$this->current = new Section();
					break;
				case 'include':
					$this->make_include($cmd_args);
					break;
				default:
					if ($this->current == null) $this->current = new Section();
					$this->current->parse($index, $cmd, $cmd_attr, $cmd_args);
			}
		}

		private function make_include ($args)
		{
			$filename = $args[1].'.php';
			if (count($args)> 2) {
				if (preg_match('/@/', $args[2])) {
					$_ = preg_split('/@/', $args[2]);
					$part = "'$_[0]'";
					$as = "'$_[2]'";
				} else {
					$part = "'$args[2]'";
					$as = 'false';
				}
			} else {
				$part = 'false';
				$as = 'false';
			}
			
			$this->content[] = "<?php dynamic_include('$filename', $part, $as); ?>";
		}

		public function setName($name)
		{
			$this->name = $name;
			$this->content[] = "<a id=\"tab-$name\"></a>";
		}

		public function closeTab()
		{
			if ($this->current) $this->content[] = $this->current->getContent();
			$this->current = null;
		}

		public function getContent($static, $first)
		{
			$content = false;
			foreach ($this->content as $_)
				$content .= $_."\n";
			$content = '<div class="tab">'.$content.'</div>'."\n";

			if ($static) {
				$result = $content;
			} else {
				$result = "<?php if (\$request['tab'] == '$this->name') { ?>\n";
				$result .= $content;
				$result .= "<?php } ?>\n";
			}

			return $result;
		}
	}
?>
