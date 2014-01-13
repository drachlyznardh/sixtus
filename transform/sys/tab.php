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

		public function parse($index, $cmd, $cmd_attr, $cmd_args)
		{
			switch($cmd)
			{
				case 'sec': $this->make_sec($cmd_args); break;
				default: $this->make_default($index, $cmd, $cmd_attr, $cmd_args); break;
			}
		}

		private function make_sec ($args)
		{
			if ($this->current != null) $this->content[] = $this->current->getContent();
			if (count($args) > 1 && strcmp($args[1], 'br') == 0)
				$this->content[] = '<br />';
			$this->current = new Section();
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

				$this->content[] = "<?php dynamic_include(\$attr, \$_SERVER['DOCUMENT_ROOT'].'$filename', $part, 'section'); ?>";
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
				$content[] = sprintf('<a id="%s"></a>', strtoupper($this->name));
			if ($this->prev)
				$content[] = sprintf("%s%s=make_prev (%s, '%s'); %s%s",
					'<', '?', '$attr', $this->prev, '?', '>');
			$content[] = implode($this->content);
			if ($this->next)
				$content[] = sprintf("%s%s=make_next (%s, '%s'); %s%s",
					'<', '?', '$attr', $this->next, '?', '>');
			$content[] = sprintf("</div>\n");

			return implode($content);
			
			$content = false;
			$result = false;
			$content = '<div class="tab">';
			if ($this->name) $content .= '<a id="'.strtoupper($this->name).'"></a>';
			foreach ($this->content as $_) $content .= $_;
			$content .= '</div>'."\n";
			
			$condition = $page ? 'tab' : 'side';
			$condition .= '_condition(';
			$condition .= $page ? "\$attr, '$this->name'" : '$attr';
			$condition .= ')';

			$result = "<?php if ($condition) { ?>\n";
			if ($page && $this->prev) {
				$result .= '<?php if (tabrel_condition($attr))';
				$result .= ' echo (make_prev($attr, \''.$this->prev.'\')); ?>';
			}
			$result .= $content;
			if ($page && $this->next) {
				$result .= '<?php if (tabrel_condition($attr))';
				$result .= ' echo (make_next($attr, \''.$this->next.'\')); ?>';
			}
			$result .= "<?php } ?>\n";

			return $result;
		}

		public function make_require ($part, $file)
		{
			if ($this->current == null) $this->current = new Section();
			$this->current->make_require ($part, $file);
		}
	}
?>
