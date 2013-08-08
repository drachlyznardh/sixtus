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

		public function getContent()
		{
			$this->content[] = $this->current->getContent();
			$content = false;
			foreach ($this->content as $_)
				$content .= $_."\n";
			return '<div class="tab">'."\n".$content."\n".'</div>'."\n";
		}
	}
?>
