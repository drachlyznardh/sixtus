<?php
	class Section
	{
		private $content;
		private $context = false;

		public function getContent()
		{
			$this->closeContext();
			$content = false;
			foreach ($this->content as $_)
				$content .= $_."\n";
			return '<div class="section">'."\n".$content."\n".'</div>'."\n";
		}

		public function parse($index, $command, $cmd_attr, $cmd_args)
		{
			switch ($command)
			{
				case '':
					if ($cmd_args[0]) {
						$this->openContext('p');
						$this->content[] = $cmd_args[0];
					}else $this->closeContext();
					break;
				case 'p':
				case 'li':
					$this->switchContext($command);
					if (count($cmd_args) > 2) {
						array_shift($cmd_args);
						$this->parse($index, $cmd_args[0], $cmd_attr, $cmd_args);
					} else $this->content[] = $cmd_args[1];
					break;
				case 'r':
					$this->switchContext('r');
					$this->content[] = $cmd_args[1];
					break;
				case 'tid':
					$this->content[] = $this->full_tid($cmd_args); break;
					break;
				case 'link':
					$this->content[] = $this->full_link($cmd_args); break;
				case 'title':
					$this->closeContext();
					if ($cmd_attr and $cmd_attr[1] == 'right')
						$this->content[] = '<h2 class="reverse">'.$cmd_args[1].'</h2>';
					else $this->content[] = '<h2>'.$cmd_args[1].'</h2>';
					break;
				case 'stitle':
					$this->closeContext();
					if ($cmd_attr and $cmd_attr[1] == 'right')
						$this->content[] = '<h3 class="reverse">'.$cmd_args[1].'</h3>';
					else $this->content[] = '<h3>'.$cmd_args[1].'</h3>';
					break;
				default:
					$this->closeContext();
					$this->content[] = '<br/><p><b><em>ERROR</em></b>: [';
					$this->content[] = $cmd_args[0];
					$this->content[] = ']</p>';
			}
		}

		private function switchContext($new)
		{
			$this->closeContext();
			$this->openContext($new);
		}

		private function closeContext()
		{
			switch ($this->context)
			{
				case 'p': $this->content[] = '</p>'; break;
				case 'r': $this->content[] = '</p>'; break;
				case 'li': $this->content[] = '</li>'; break;
				case 'inside': $this->content[] = '</div>'; break;
				case 'outside': $this->content[] = '</div>'; break;
			}
			$this->context = false;
		}

		private function openContext($new)
		{
			if ($this->context == $new) return;
			
			$this->context = $new;
			switch ($this->context)
			{
				case 'p': $this->content[] = '<p>'; break;
				case 'r': $this->content[] = '<p class="reverse">'; break;
				case 'li': $this->content[] = '<li>'; break;
				case 'inside': $this->content[] = '<div class="inside">'; break;
				case 'outside': $this->content[] = '<div class="outside">'; break;
			}
		}

		private function full_link ($args)
		{
			$destination = polish_line($args[1]);
			if (preg_match('/@/', polish_line($args[2]))) {
				$_ = preg_split('/@/', $args[2]);
				switch(count($_)) {
					case 2:
						$before = false;
						$title = $_[0];
						$after = $_[1];
						break;
					case 3:
						$before = $_[0];
						$title = $_[1];
						$after = $_[2];
						break;
				}
			} else {
				$title = $args[2];
				$before = $after = false;
			}

			$count = count($args);
			if ($count > 3) $tab = $args[3]; else $tab = 'false';
			if ($count > 4) $hash = $args[4]; else $hash = 'false';
			
			$url = "<?=make_canonical(\$attr, '$destination', '$tab', '$hash')?>";
			if ($before) $result = $before; else $result = false;
			$result .= "<a href=\"$url\">$title</a>";
			if ($after) $result .= $after;
			
			return $result;
		}

		private function full_tid ($args)
		{
			$destination = "\$search['page'][0]";
			if (preg_match('/@/', $args[1])) {
				$_ = preg_split('/@/', polish_line($args[1]));
				switch(count($_)){
					case 2:
						$before = false;
						$title = $_[0];
						$after = $_[1];
						break;
					case 3:
						$before = $_[0];
						$title = $_[1];
						$after = $_[2];
						break;
				}
			} else {
				$title = $args[1];
				$before = $after = false;
			}

			$count = count($args);
			if ($count > 2) $tab = $args[2]; else $tab = 'false';
			if ($count > 3) $hash = $args[3]; else $hash = 'false';
			
			$url = "<?=make_canonical(\$attr, $destination, '$tab', '$hash')?>";
			if ($before) $result = $before; else $result = false;
			$result .= "<a href=\"$url\">$title</a>";
			if ($after) $result .= $after;
			
			return $result;
		}
	}
?>
