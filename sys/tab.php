<?php
	class Tab
	{
		private $content;
		private $current;
		private $name;

		public function __construct()
		{
			$this->current = new Section();
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
				default:
					$this->current->parse($index, $cmd, $cmd_attr, $cmd_args);
			}
		}

		public function setName($name)
		{
			$this->name = $name;
			$this->content[] = "<a id=\"tab-$name\"></a>";
		}

		public function closeTab()
		{
			$this->content[] = $this->current->getContent();
			$this->current = null;
		}

		public function getContent($static, $first)
		{
			$content = false;
			foreach ($this->content as $_)
				$content .= $_."\n";
			$content = '<div class="tab">'."\n".$content."\n".'</div>'."\n";

			if ($static) {
				$result = "<!-- Tab[$this->name]/START -->\n";
				$result .= $content;
				$result .= "<!-- Tab[$this->name]/STOP -->\n";
			} else {
				$result = "<?php if (\$request['tab'] == '$this->name') { ?>\n";
				$result .= $content;
				$result .= "<?php } ?>\n";
			}

			return $result;
		}
	}
?>
