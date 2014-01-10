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

				$this->content[] = "<?php dynamic_include(\$attr, \$_SERVER['DOCUMENT_ROOT'].'$filename', $part, true); ?>";
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
			$content[] = '<div class="tab">';
			if ($this->name)
				$content[] = sprintf('<a id="%s">', strtoupper($this->name));
			$content[] = implode($this->content);
			$content[] = '</div>';

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
	}
?>
