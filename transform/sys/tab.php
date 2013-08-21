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
				case 'sec': $this->make_sec(); break;
				case 'sbr': $this->make_sbr(); break;
				default: $this->make_default($index, $cmd, $cmd_attr, $cmd_args); break;
			}
		}

		private function make_sec ()
		{
			if ($this->current != null) $this->content[] = $this->current->getContent();
			$this->current = new Section();
		}

		private function make_sbr ()
		{
			if ($this->current != null) $this->content[] = $this->current->getContent();
			$this->content[] = '<br />';
			$this->current = null;
		}

		public function make_include ($filename, $part, $as)
		{
			if ($as && strcmp($as, '\'content\'') == 0) {
				if ($this->current == null) $this->current = new Section();
				$this->current->make_include($filename, $part);
			} else {
				if ($this->current != null)
				{
					$this->content[] = $this->current->getContent();
					$this->current = null;
				}

				$this->content[] = "<?php dynamic_include(\$attr, '$filename', $part, true); ?>";
			}
		}

		private function make_default ($index, $cmd, $cmd_attr, $cmd_args)
		{
			if ($this->current == null) $this->current = new Section();
			$this->current->parse($index, $cmd, $cmd_attr, $cmd_args);
		}

		public function setName($name)
		{
			$this->name = $name;
			$this->content[] = '<a id="'.strtoupper($name).'"></a>';
		}

		public function closeTab()
		{
			if ($this->current) $this->content[] = $this->current->getContent();
			$this->current = null;
		}

		public function getContent($page)
		{
			$content = false;
			$result = false;
			foreach ($this->content as $_) $content .= $_;
			$content = '<div class="tab">'.$content.'</div>'."\n";
			
			$condition = $page ? 'tab' : 'side';
			$condition .= '_condition(';
			$condition .= $page ? "\$attr, '$this->name'" : '$attr';
			$condition .= ')';

			$result = "<?php if ($condition) { ?>\n";
			$result .= $content;
			$result .= "<?php } ?>\n";

			return $result;
		}
	}
?>
