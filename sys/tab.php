<?php
	class Tab
	{
		private $content;
		private $current;

		public function __construct()
		{
			$this->current = new Section();
			$this->content = array();
		}

		public function parse($index, $cmd, $cmd_attr, $cmd_args)
		{
			switch($cmd)
			{
				case 'sec':
					$this->content[] = $this->current->getContent();
					$this->current = new Section();
					break;
				default:
					$this->current->parse($index, $cmd, $cmd_attr, $cmd_args);
			}
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
