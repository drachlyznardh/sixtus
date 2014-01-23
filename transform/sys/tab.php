<?php
	class Tab
	{
		private $content;
		private $current;
		private $name;

		private $prev;
		private $next;

		public function __construct()
		{
			$this->current = null;
			$this->content = array();

			$this->name = false;
			$this->prev = $this->next = false;
		}

		public function parse($index, $cmd, $attr, $args)
		{
			switch($cmd)
			{
				case 'sec': $this->make_sec($index, $cmd, $attr, $args); break;
				default: $this->make_default($index, $cmd, $attr, $args); break;
			}
		}

		private function make_sec ($index, $cmd, $attr, $args)
		{
			if ($this->current != null) $this->content[] = $this->current->getContent();
			if (count($args) > 1 && strcmp($args[1], 'br') == 0)
				$this->content[] = '<br />';

			$this->current = new Section();
			if (isset($attr[1])) $this->current->setId($attr[1]);
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

				$this->content[] = "<?php dynamic_include(\$attr, docroot().'$filename', $part, 'section'); ?>";
			}
		}

		private function make_default ($index, $cmd, $cmd_attr, $cmd_args)
		{
			if ($this->current == null) $this->current = new Section();
			$this->current->parse($index, $cmd, $cmd_attr, $cmd_args);
		}

		public function setName($name) { $this->name = $name; }
		public function getName() { return $this->name; }
		public function setNext ($name) { $this->next = $name; }
		public function setPrev ($name) { $this->prev = $name; }

		public function closeTab()
		{
			if ($this->current) $this->content[] = $this->current->getContent();
			$this->current = null;
		}

		public function getContent($page)
		{
			$content[] = sprintf('<div class="%s">', 'tab', "\n");
			if ($this->name)
				$content[] = sprintf('<a id="%s"></a>', mb_strtoupper($this->name, 'UTF-8'));
			if ($this->prev)
				$content[] = sprintf("%s%s=make_prev(%s, '%s', %s)%s%s",
					'<', '?', '$attr', $this->prev, '$standalone', '?', '>');
			$content[] = implode($this->content);
			if ($this->next)
				$content[] = sprintf("%s%s=make_next(%s, '%s', %s)%s%s",
					'<', '?', '$attr', $this->next, '$standalone', '?', '>');
			$content[] = sprintf("</div>\n");

			return implode($content);
		}
	}
?>
