<?php
	class Section
	{
		public  $id = false;

		private $content = array();
		private $context = false;
		private $environment;
		private $defaultContext = 'p';

		public function getContent()
		{
			$this->closeContext();
			if (count($this->content) == 0) return;

			$result[] = sprintf("%s?=%s?'%s':''?%s", '<', '$s', '<div class="section">', '>');
			if ($this->id) $result[] = sprintf('<a id="%s"></a>', $this->id);
			$result[] = implode("\n", $this->content);
			$result[] = sprintf("%s?=%s?'%s':''?%s", '<', '$s', '</div>', '>');

			return implode("\n", $result);
		}

		public function parse($f, $index, $command, $cmd_attr, $cmd_args)
		{
			switch ($command)
			{
				case 'tag': break;
				
				case '': $this->make_text(trim($cmd_args[0])); break;
				case 'id': $this->make_id($cmd_args[1]); break;
				case 'p': $this->make_p($f, $index, $cmd_args, $cmd_attr); break;
				case 'c': $this->make_c($f, $index, $cmd_args, $cmd_attr); break;
				case 'r': $this->make_r($f, $index, $cmd_args, $cmd_attr); break;
				case 'tid': $this->make_tid($f, $index, $cmd_args); break;
				case 'link': $this->make_link($f, $index, $cmd_args); break;
				case 'title': $this->make_title($f, $index, $cmd_args, $cmd_attr); break;
				case 'stitle': $this->make_stitle($f, $index, $cmd_args, $cmd_attr); break;
				case 'img': $this->make_img($cmd_args); break;
				case 'begin': $this->make_begin($cmd_args, $cmd_attr); break;
				case 'end': $this->make_end($cmd_args, $cmd_attr); break;
				case 'br': $this->make_break(); break;
				case 'clear': $this->make_clear($f, $index, $cmd_args); break;
				case 'speak': $this->make_intra($f, $index, $cmd_args, $cmd_attr); break;
				case 'search': $this->make_search($f, $index, $cmd_args, $cmd_attr); break;

				case 'require':
					$this->make_require($f, $index, $cmd_args, $cmd_attr);
					break;

				default: fail("Unknown command [$command]", $f, $index); $this->error($f, $index, $command);
			}
		}

		private function error ($f, $index, $command)
		{
			printf("Section ERROR[%s] in %s @line %d\n", $command, $index[0], $index[1]);
			exit(1);
		}

		public function make_require ($f, $l, $args, $attr)
		{
			$this->closeContext();

			$open = sprintf("%s%s", '<', '?php');
			$close = sprintf("%s%s", '?', '>');

			switch ($attr[1])
			{
				case 'tab':
				case 'ghost':
					if (count($attr) < 2)
						fail("Section->Make_Require: Tabs & Ghosts require a name.\n");
					$this->content[] = sprintf("<%s=require_one(%s, '%s/%s-%s.php')%s>",
						'?', '$attr', $args[1], $attr[1], $attr[2], '?');
					break;
				case 'side':
					$this->content[] = sprintf("<%s=require_one(%s, '%s/side.php')%s>",
						'?', '$attr', $args[1], '?');
					break;
				case 'body':
					$this->content[] = sprintf("<%s=require_all(%s, '%s/meta.php')%s>",
						'?', '$attr', $args[1], '?');
					break;
				default:
					fail("Section->Make_Require: [$attr[1]] unknown.\n", $f, $l);	
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
				case 'p':
				case 'c':
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
			
			if ($this->context == 'r' && $new == 'p') return;
			if ($this->context == 'p' && $new == 'r') return;
			if ($this->context == 'r' && $new == 'c') return;
			if ($this->context == 'p' && $new == 'c') return;
			if ($this->context == 'c' && $new == 'p') return;
			if ($this->context == 'c' && $new == 'r') return;
			
			$this->context = $new;
			switch ($this->context)
			{
				case 'p': $this->content[] = '<p>'; break;
				case 'c': $this->content[] = '<p class="center">'; break;
				case 'r': $this->content[] = '<p class="reverse">'; break;
				case 'li': $this->content[] = '<li>'; break;
				case 'inside': $this->content[] = '<div class="inside">'; break;
				case 'outside': $this->content[] = '<div class="outside">'; break;
			}
		}

		private function full_link ($f, $index, $args)
		{
			if ($args[1]) $destination = '\''.polish_line($args[1]).'\'';
			else $destination = '$attr[\'self\']';

			$args[2] = polish_line($args[2]);
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
			if ($count > 3) $tab = "'$args[3]'"; else $tab = 'false';
			if ($count > 4) $hash = "'$args[4]'"; else $hash = 'false';
			if ($count > 5) $this->error($f, $index, 'Link: too many arguments');
			
			$url = '<'."?=make_canonical(\$attr, $destination, $tab, $hash)?".'>';
			if ($before) $result = $before; else $result = false;
			$result .= "<a href=\"$url\">$title</a>";
			if ($after) $result .= $after;
			
			return $result;
		}

		private function full_tid ($f, $index, $args)
		{
			$argument = polish_line($args[1]);
			$destination = "\$search['page'][0]";
			if (preg_match('/@/', $argument)) {
				$_ = preg_split('/@/', polish_line($argument));
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
			if ($count > 2) $tab = '\''.mb_strtolower($args[2], 'UTF-8').'\''; else $tab = "false";
			if ($count > 3) $hash = '\''.$args[3].'\''; else $hash = "false";
			if ($count > 4) $this->error($f, $index, 'Tid: too many arguments');
			
			if ($before) $result = $before; else $result = false;
			$result .= "<?=make_tid(\$attr, '".polish_line($title)."', $tab, $hash)?>";
			if ($after) $result .= $after;
			

			return $result;
		}

		private function full_img ($args)
		{
			switch(count($args))
			{
				case 2:
					$destination = $thumbnail = polish_line($args[1]);
					break;
				case 3:
					$destination = polish_line($args[1]);
					$thumbnail = polish_line($args[2]);
					break;
			}

			$image = "<img src=\"$thumbnail\" />";
			$link = "<a class=\"img\" target=\"_blank\" href=\"$destination\">$image</a>";
			return $link;
			$result = "<p class=\"img\">$link</p>";
			return $result;
		}

		private function make_text ($text)
		{
			if ($text) {
					
				$text = polish_line($text);

				if (preg_match('/^</', $text)) {
					$this->content[] = $text;
				} else if (preg_match('/^>/', $text)) {
					$this->openContext($this->defaultContext);
					$this->content[] = "<span class=\"green\">$text</span>\n";
				} else {
					$this->openContext($this->defaultContext);
					$this->content[] = $text;
				}
			
			} else $this->closeContext();
		}

		private function make_id ($id)
		{
			$this->content[] = '<a id="'.$id.'"></a>';
		}

		private function make_p ($f, $index, $cmd_args, $cmd_attr)
		{
			$this->switchContext($this->defaultContext);
			if (count($cmd_args) > 2) $this->recursive($f, $index, $cmd_args, $cmd_attr);
			else if ($cmd_args[1]) $this->make_text($cmd_args[1]);
		}

		private function make_c ($f, $index, $cmd_args, $cmd_attr)
		{
			$this->switchContext('c');
			if (count($cmd_args) > 3) $this->recursive($f, $index, $cmd_args, $cmd_attr);
			else $this->make_text($cmd_args[1]);
		}

		private function make_r ($f, $index, $cmd_args, $cmd_attr)
		{
			$this->switchContext('r');
			if (count($cmd_args) > 2) $this->recursive($f, $index, $cmd_args, $cmd_attr);
			else $this->make_text($cmd_args[1]);
		}

		private function recursive ($f, $index, $cmd_args, $cmd_attr)
		{
			array_shift($cmd_args);
			if (preg_match('/@/', $cmd_args[0])) {
				$cmd_attr = preg_split('/@/', $cmd_args[0]);
				$command = $cmd_attr[0];
			} else {
				$command = $cmd_args[0];
				$cmd_attr = array($command);
			}
			$this->parse($f, $index, $command, $cmd_attr, $cmd_args);
		}

		private function make_tid ($f, $index, $args)
		{
			$this->content[] = ' '.$this->full_tid($f, $index, $args);
		}

		private function make_link ($f, $index, $args)
		{
			$this->content[] = ' '.$this->full_link($f, $index, $args);
		}

		private function make_title ($f, $l, $cmd_args, $cmd_attr)
		{
			$this->closeContext();
			if (isset($cmd_attr[1]) and $cmd_attr[1] == 'right')
				$open_tag = '<h2 class="reverse">';
			else $open_tag = '<h2>';

			$this->content[] = "\n".$open_tag;
			if (count($cmd_args) > 2) {
				array_shift($cmd_args);
				$this->parse($l, $cmd_args[0], $cmd_attr, $cmd_args);
			} else $this->content[] = polish_line($cmd_args[1]);
			$this->content[] = '</h2>'."\n";
		}

		private function make_stitle ($f, $l, $cmd_args, $cmd_attr)
		{
			$this->closeContext();
			if (isset($cmd_attr[1]) and $cmd_attr[1] == 'right')
				$open_tag = '<h3 class="reverse">';
			else $open_tag = '<h3>';

			$this->content[] = "\n".$open_tag;
			if (count($cmd_args) > 2) {
				array_shift($cmd_args);
				$this->parse($f, $l, $cmd_args[0], $cmd_attr, $cmd_args);
			} else $this->content[] = polish_line($cmd_args[1]);
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
				$side = preg_split('/@/', $args[1]);
				$env = $side[0];
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
				case 'double':
				case 'triple':
					$this->content[] = "<div class=\"$env-col\">";
					break;
				case 'ul':
				case 'ol':
					switch (count($side)) {
						case 5: $style = " $side[1]=\"$side[2]\" $side[3]=\"$side[4]\""; break;	
						case 3: $style = " $side[1]=\"$side[2]\""; break;
						case 1: $style = false;
					}
					$this->content[] = "<$env$style>";
					$this->defaultContext = 'li';
					break;
				case 'roman':
					switch (count($attr)) {
						case 1:
							$this->content[] = '<ol class="roman">'; break;
						case 2:
							$this->content[] = '<ol class="roman" style="margin-left: '.$attr[1].'">';
							break;
						default:
							$this->content[] = '<ol class="roman" style="margin-left: '.$attr[1].'" start="'.$attr[2].'">';
					}
					$this->defaultContext = 'li';
					break;
				case 'mini':
				case 'half':
					if ($side) {
						$this->content[] = "<div class=\"$env-$side[1]-out\">";
						$this->content[] = "<div class=\"$env-$side[1]-in\">";
					}
					else fail ("Environment[$env] needs a side");
					break;
				default:
					fail("Unknown environment[$env]\n");
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
				case 'roman':
					$this->content[] = '</ol>';
					$this->defaultContext = 'p';
					break;
				case 'inside':
				case 'outside':
				case 'double':
				case 'triple':
					$this->content[] = '</div>';
					break;
				case 'mini':
				case 'half':
					$this->content[] = '</div></div>';
					break;
				default:
					fail("Unknown environment[$args[1]]");
			}
		}

		private function make_break ()
		{
			$this->closeContext();
			$this->content[] = '<div class="spacer"></div>'."\n";
		}

		private function make_clear ($l, $args)
		{
			$this->closeContext();
			if (count($args) > 1 && $args[1]) $clear = $args[1];
			else $clear = 'both';
			$this->content[] = "\n".'<div style="float:none; clear:'.$clear.'"></div>'."\n";
		}

		private function make_intra ($l, $args, $attr)
		{
			$result = false;
			if (count($args) > 2)
				$this->error($l, 'Speak: too many arguments');
	
			$_ = preg_split('/@/', $args[1]);

			$result = $this->dialog($attr[1], polish_line($_[0]));
			array_shift($_);
			while (count($_))
			{
				$result .= ' – '.polish_line($_[0]).' – ';
				$result .= $this->dialog($attr[1], polish_line($_[1]));
				array_shift($_);
				array_shift($_);
			}

			$this->content[] = $result;
		}

		private function dialog ($author, $line)
		{
			return ' <span class="'.$author.'" title="'.$author.'">« '.$line.' »</span> ';
		}

		private function make_search ($f, $index, $args, $attr) 
		{
			switch ($args[1])
			{
				case 'result':
					$this->content[] = '<'.'?php include_search_result($attr); ?'.'>';
					break;
				case 'cloud':
					$this->content[] = '<'.'?php include_search_cloud($attr)?'.'>';
					break;
				case 'static':
					$data = explode('+', $attr[1]);
					$this->content[] = sprintf("%s?php %s(%s, array('%s'))?%s",
						'<',
						'display_search_result',
						'$attr',
						implode("', '", $data),
						'>');
					break;
				case 'search':
				default:
					$this->content[] = '<'.'?php include_search_form();?'.'>';
			}
		}
	}
?>
