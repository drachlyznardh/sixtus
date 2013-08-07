<?php
	class Section
	{
		private $content = array();
		private $context = false;
		private $environment;
		private $defaultContext = 'p';

		public function getContent()
		{
			$this->closeContext();
			$content = false;
			foreach ($this->content as $_)
				$content .= $_;
			return '<div class="section">'."\n".$content.'</div>'."\n";
		}

		public function parse($index, $command, $cmd_attr, $cmd_args)
		{
			switch ($command)
			{
				case '': $this->make_text(trim($cmd_args[0])); break;
				case 'id': $this->make_id($cmd_args[1]); break;
				case 'p':
				case 'li': $this->make_p($index, $cmd_args, $cmd_attr); break;
				case 'r':
				case 'reverse': $this->make_r($index, $cmd_args, $cmd_attr); break;
				case 'tid': $this->make_tid($cmd_args); break;
				case 'link': $this->make_link($cmd_args); break;
				case 'title': $this->make_title($index, $cmd_args, $cmd_attr); break;
				case 'stitle': $this->make_stitle($index, $cmd_args, $cmd_attr); break;
				case 'foto':
				case 'photo':
				case 'img': $this->make_img($cmd_args); break;
				case 'begin': $this->make_begin($cmd_args, $cmd_attr); break;
				case 'end': $this->make_end($cmd_args, $cmd_attr); break;
				case 'br': $this->make_break(); break;
				case 'clear': $this->make_clear(); break;
				default:
					printf ("ERROR [$command] @ line $index\n");
					exit(1);
					$this->closeContext();
					$this->content[] = '<br/><p class="error">ERROR: [';
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
			$this->content[] = "\n";
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

		private function full_img ($args)
		{
			switch(count($args))
			{
				case 2:
					$destination = $thumbnail = $args[1];
					break;
				case 3:
					$destination = $args[1];
					$thumbnail = $args[2];
					break;
			}

			$image = "<img src=\"$thumbnail\" />";
			$link = "<a target=\"_blank\" href=\"$destination\">$image</a>";
			$result = "<p class=\"foto\">$link</p>";
			return $result;
		}

		private function make_text ($text)
		{
			if ($text) {
				$this->openContext($this->defaultContext);
				$this->content[] = " $text";
			} else $this->closeContext();
		}

		private function make_id ($id)
		{
			$this->content[] = '<a id="'.$id.'"></a>';
		}

		private function make_p ($index, $cmd_args, $cmd_attr)
		{
			$this->switchContext($cmd_args[0]);
			if (count($cmd_args) > 2) {
				array_shift($cmd_args);
				$this->parse($index, $cmd_args[0], $cmd_attr, $cmd_args);
			} else $this->content[] = $cmd_args[1];
		}

		private function make_r ($index, $cmd_args, $cmd_attr)
		{
			$this->switchContext('r');
			if (count($cmd_args) > 2) {
				array_shift($cmd_args);
				$this->parse($index, $cmd_args[0], $cmd_attr, $cmd_args);
			} else $this->content[] = $cmd_args[1];
		}

		private function make_tid ($args)
		{
			$this->content[] = ' '.$this->full_tid($args);
		}

		private function make_link ($args)
		{
			$this->content[] = ' '.$this->full_link($args);
		}

		private function make_title ($lineno, $cmd_args, $cmd_attr)
		{
			$this->closeContext();
			if ($cmd_attr and $cmd_attr[1] == 'right')
				$this->content[] = '<h2 class="reverse">'.$cmd_args[1].'</h2>';
			else $this->content[] = '<h2>'.$cmd_args[1].'</h2>';
			$this->content[] = "\n";
		}

		private function make_stitle ($lineno, $cmd_args, $cmd_attr)
		{
			$this->closeContext();
			if ($cmd_attr and $cmd_attr[1] == 'right')
				$open_tag = '<h3 class="reverse">';
			else $open_tag = '<h3>';

			$this->content[] = $open_tag;
			if (count($cmd_args) > 2) {
				array_shift($cmd_args);
				$this->parse($lineno, $cmd_args[0], $cmd_attr, $cmd_args);
			}
			$this->content[] = '</h3>'."\n";
		}

		private function make_img ($args)
		{
			$this->closeContext();
			$this->content[] = $this->full_img($args);
		}

		private function make_begin ($args, $attr)
		{
			if (preg_match('/@/', $args[1])) {
				list($env, $side) = preg_split('/@/', $args[1]);
			} else {
				$env = $args[1];
				$side = false;
			}
			
			$this->closeContext();
			switch($env)
			{
				case 'inside':
				case 'outside':
					$this->content[] = "<div class=\"$env\">";
					$this->environment = 'inside';
					break;
				case 'ul':
				case 'ol':
					$this->content[] = "<$env>";
					$this->defaultContext = 'li';
					break;
				case 'mini':
				case 'half':
					if ($side) $this->content[] = "<div class=\"$env-$side\">";
					else die ("Environment[$env] needs a side");
					break;
				default:
					die("Unknown environment[$env]\n");
			}
		}

		private function make_end ($args, $attr)
		{
			$this->closeContext();
			switch ($args[1])
			{
				case 'ul':
				case 'ol':
					$this->content[] = "</$args[1]>";
					$this->defaultContext = 'p';
					break;
				case 'inside':
				case 'outside':
				case 'mini':
				case 'half':
					$this->content[] = '</div>';
					break;
				default:
					die("Unknown environment[$args[1]]");
			}
		}

		private function make_break ()
		{
			$this->closeContext();
			$this->content[] = '<br/>';
		}

		private function make_clear ()
		{
			$this->closeContext();
			$this->content[] = '<div style="float:none; clear:both"></div>';
		}
	}
?>
