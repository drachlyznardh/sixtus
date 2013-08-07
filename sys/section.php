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
					$this->switchContext('p');
					$this->content[] = $cmd_args[1];
					break;
				case 'r':
					$this->switchContext('r');
					$this->content[] = $cmd_args[1];
					break;
				case 'tid':
					$this->content[] = "<?=make_tid(\$attr, \$request['tab'], \$search['page'][0], '$cmd_args[1]', '$cmd_args[2]')?>";
					break;
				case 'link':
					$dest = polish_line($cmd_args[1]);
					$title = polish_line($cmd_args[2]);
					$url = "<?=make_canonical(\$attr, '$dest', '$title')?>";
					$this->content[] = "<a href=\"$url\">$title</a>";
					break;
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
	}
?>
