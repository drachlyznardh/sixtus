<?php

	class Parser {
	
		private $pstate;

		private $prefix;
		private $target;

		private $title;
		private $subtitle;
		private $keywords;

		private $prev;
		private $next;

		private $current;
		public $body;
		public $side;

		private $first_tab;
		private $default_tab;
		private $force_all_tabs;
		private $all_or_one;

		public function __construct ($prefix)
		{
			$this->pstate = 'meta';
			$this->prefix = $prefix;

			$this->title = false;
			$this->short = false;
			$this->subtitle = false;
			$this->keywords = false;

			$this->prev = false;
			$this->next = false;

			$this->current = null;
			$this->body = array();
			$this->side = array();

			$this->first_tab = true;
			$this->default_tab = false;
			$this->force_all_tabs = false;
			$this->all_or_one = false;
		}

		private function open_env($target)
		{
			$this->close_env();
			switch ($target)
			{
				case 'meta':
					$this->pstate = 'meta';
					break;
				case 'page':
				case 'body':
					$this->pstate = 'body';
					$this->current = new Tab();
					break;
				case 'side':
					$this->pstate = 'side';
					$this->current = new Tab();
					break;
				default:
					fail("Parser->Open_Env: unknown env[$target]\n");
			}
		}

		public function close_env()
		{
			switch($this->pstate) {
				case 'meta':
					break;
				case 'side':
					$this->pstate = 'meta';
					$this->current->closeTab();
					$this->side[] = $this->current;
					$this->current = null;
					break;
				case 'page':
				case 'body':
					$this->pstate = 'meta';
					$this->current->closeTab();
					$this->body[] = $this->current;
					$this->current = null;
					break;
				default:
					fail("Parser->Open_Env: unknown PState [$this->pstate]\n");
			}
		}

		public function parse($filename)
		{
			$this->target = $filename;
			$this->include_base = dirname($filename);
			$index = array($filename, 0);
			
			if (!file_exists($filename))
			{
				echo("\n<!-- [$filename] does not exists, cannot parse -->");
				return false;
			}
			$rows = file ($filename, FILE_IGNORE_NEW_LINES);

			foreach ($rows as $_)
			{
				$index[1]++;
				if (preg_match('/^#.*/', $_)) {
					#printf("\tLine#$index is a comment\n");
				} else if (preg_match('/#/', $_)) {
					$fragment = split('#', trim($_));
					if (preg_match('/@/', $fragment[0])) {
						$cmd_attr = split('@', $fragment[0]);
						$command = $cmd_attr[0];
					} else $command = $cmd_attr = $fragment[0];

					if (strcmp($command, 'start') == 0)
						$this->open_env($fragment[1]);
					else if (strcmp($command, 'stop') == 0)
						$this->close_env();
					else switch ($this->pstate) {
						case 'meta':
							$this->parse_meta($index, $command, $cmd_attr, $fragment);
							break;
						case 'side':
							$this->parse_side($index, $command, $cmd_attr, $fragment);
							break;
						case 'body':
							$this->parse_body($index, $command, $cmd_attr, $fragment);
							break;
						default:
							fail("Parser->parse: unknown pstate [$pstate]\n");
					}
				} else if ($this->pstate != 'meta') {
					$this->current->parse($index, '', '', array(polish_line($_)));
				}
			}

			$this->close_env();
		}

		private function parse_meta ($lineno, $cmd, $cmd_attr, $cmd_par)
		{
			switch($cmd) {
				case 'tag': break;
				case 'related': break;
				case 'title':
					switch(count($cmd_par)){
						case 3:
							$this->subtitle = polish_line($cmd_par[2]);
						case 2:
							$this->title = polish_line($cmd_par[1]);
							$this->short = $this->title;
							break;
					}
					break;
				case 'short':
					$this->short = polish_line($cmd_par[1]);
					break;
				case 'subtitle':
					$this->subtitle = polish_line($cmd_par[1]);
					break;
				case 'keywords':
					$this->keywords = polish_line($cmd_par[1]);
					break;
				case 'prev':
					$this->prev = array($cmd_par[1], polish_line($cmd_par[2]));
					break;
				case 'next':
					$this->next = array($cmd_par[1], polish_line($cmd_par[2]));
					break;
				case 'tabs':
					if ($cmd_par[1] == 'alwaysall')
						$this->force_all_tabs = true;
					else if (strcmp($cmd_par[1], 'all_or_one') == 0)
						$this->all_or_one = true;
					break;
				case 'include':
					$this->static_include($cmd_par, $cmd_attr);
					break;
				default:
					fail("Parser->parse_meta: unknown command [$cmd]\n");
			}
		}

		private function parse_side ($lineno, $cmd, $cmd_attr, $cmd_args)
		{
			$this->current->parse($lineno, $cmd, $cmd_attr, $cmd_args);
		}

		private function parse_body ($lineno, $cmd, $cmd_attr, $cmd_args)
		{
			switch ($cmd) {
				case 'tab':
					if ($this->first_tab) {
						$this->current->setName($cmd_args[1]);
						$this->first_tab = false;
						$this->default_tab = $cmd_args[1];
					} else {
						$previous = $this->current->getName();
						$this->current->closeTab();
						$this->current->setNext($cmd_args[1]);
						$this->body[] = $this->current;
						$this->current = new Tab();
						$this->current->setName($cmd_args[1]);
						$this->current->setPrev($previous);
					}
					break;
				default:
					$this->current->parse($lineno, $cmd, $cmd_attr, $cmd_args);
			}
		}

		private function make_include ($args)
		{
			$filename = $args[1].'.php';
			$part = false;
			$as = false;

			if (count($args)> 2)
				if (preg_match('/@/', $args[2])) {
					$_ = preg_split('/@/', $args[2]);
					$part = "'$_[0]'";
					$as = "'$_[2]'";
				} else $part = "'$args[2]'";
	
			if ($part)
				$this->current->make_include($filename, $part, $as);
			else {
				$this->current->closeTab();
				$this->body[] = $this->current;
				
				$parser = new Parser($this->prefix);
				$parser->parse("$this->prefix/$args[1].lyz")
					or $parser->parse("$this->prefix/$args[1].slyz")
					or $parser->parse("$this->prefix/$args[1].pag");
				foreach ($parser->body as $_)
					$this->body[] = $_;
			}
		}

		private function static_include ($args, $attr)
		{
			$filename = $args[1];

			if (is_file($filename)) $includefile = $filename;
			else {
				$includefile = $this->include_base.'/'.$filename;
				if (!is_file($includefile))
				{
					$includefile = $this->prefix.'/'.$filename;
					if (!is_file($includefile)) 
						fail (sprintf ("Cannot locate [%s], from [%s] nor from [%s] while scanning [%s]\n",
							$filename, $this->include_base, $this->prefix, $this->target));
				}
			}

			$parser = new Parser($this->prefix);
			$parser->parse($includefile);
			foreach ($parser->body as $_)
				$this->body[] = $_;
			foreach ($parser->side as $_)
				$this->side[] = $_;
		}

		private function deploy_attr ()
		{
			$format = "\t%s['%s'] = '%s';\n";
			
			$to_file[] = sprintf($format, '$attr', 'title', $this->title);
			$to_file[] = sprintf($format, '$attr', 'short', $this->short);
			$to_file[] = sprintf($format, '$attr', 'subtitle', $this->subtitle);
			$to_file[] = sprintf($format, '$attr', 'keywords', $this->keywords);
			if ($this->force_all_tabs)
				$to_file[] = sprintf($format, '$attr', 'force_all_tabs', 'true');
			else if ($this->all_or_one) 
				$to_file[] = sprintf($format, '$attr', 'all_or_one', 'true');
			else 
				$to_file[] = sprintf("\tif(!%s['part'] && %s['single']) %s['part'] = '%s';\n",
					'$attr', '$attr', '$attr', $this->body[0]->getName());
			$to_file[] = sprintf("\tif(!%s['current']) %s['current'] = '%s';\n",
				'$attr', '$attr', $this->body[0]->getName());
			$to_file[] = sprintf("\n");
			if ($this->prev)
				$to_file[] = sprintf("\t%s['%s'] = array('%s', '%s');\n",
					'$related', 'prev', $this->prev[0], $this->prev[1]);
			else $to_file[] = sprintf("\t%s['%s'] = %s;\n", '$related', 'prev', 'false');
			if ($this->next)
				$to_file[] = sprintf("\t%s['%s'] = array('%s', '%s');\n",
					'$related', 'next', $this->next[0], $this->next[1]);
			else $to_file[] = sprintf("\t%s['%s'] = %s;\n", '$related', 'next', 'false');

			return implode($to_file);
		}

		private function link_tabs()
		{
			$previous = false;
			$current = false;
			foreach ($this->body as $_)
			{
				$previous = $current;
				$current = $_;

				if ($previous && $current)
				{
					$previous->setNext($current->getName());
					$current->setPrev($previous->getName());
				}
			}
		}

		private function write_side_file ($target, $unique)
		{
			$target_file = sprintf('%sright-side.php', $target);
			#printf("\tPutting side content into [%s]\n", $target_file);
		
			$to_file[] = sprintf("%s%s function %s_right_side (%s, %s, %s) { %s%s\n",
				'<', '?php', underscore($unique), '$attr', '$sec', '$standalone', '?', '>');
			foreach($this->side as $_)
				$to_file[] = $_->getContent(false);
			$to_file[] = sprintf("%s%s } %s%s\n", '<', '?php', '?', '>');

			file_put_contents($target_file, $to_file);
			return;
		}

		private function write_content_file ($target, $unique)
		{
			$target_file = sprintf('%scontent.php', $target);
			$prefix = underscore($unique);
			#printf("\tPutting content into [%s]\n", $target_file);
	
			if (count($this->body) > 1 || $this->body[0]->getName())
			{
				$to_file[] = sprintf("%s%s function %s (%s, %s, %s) {\n",
					'<', '?php',
					function_name('body', $prefix, false),
					'$attr', '$sec', '$standalone');
				#$to_file[] = sprintf("\t%s['%s'] = true;\n", '$attr', 'included');
				foreach($this->body as $_)
				{
					$to_file[] = sprintf("\trequire_once(%s);\n",
						function_file('tab', $unique, $_->getName()));
					$to_file[] = sprintf("\t%s (%s, %s, %s);\n",
						function_name('tab', $prefix, $_->getName()),
						'$attr', 'true', 'false');
				}
				$to_file[] = sprintf("} %s%s\n", '?', '>');
			}
			else
			{
				$to_file[] = sprintf("%s%s function %s (%s, %s, %s) {%s%s\n",
					'<', '?php',
					function_name('body', $prefix, false),
					'$attr', '$sec', '$standalone',
					'?', '>');
				#$to_file[] = sprintf("\t%s['%s'] = true; %s%s\n", '$attr', 'included', '?', '>');
				$to_file[] = $this->body[0]->getContent(true);
				$to_file[] = sprintf("%s%s } %s%s\n", '<', '?php', '?', '>');
			}

			file_put_contents($target_file, $to_file);
			return;
		}

		private function write_page_file ($target, $unique)
		{
			$header = "\n\t### %s\n";
			$prefix = underscore($unique);
			$target_file = sprintf('%spage.php', $target);
			#printf("\tPutting page data into [%s]\n", $target_file);
		
			$to_file[] = sprintf("%s%s if (!%s['%s']) {\n",
				'<', '?php', '$attr', 'included');
			
			### data
			$to_file[] = sprintf($header, 'data');
			$to_file[] = $this->deploy_attr();
			
			### settings
			$to_file[] = sprintf($header, 'settings');
			$to_file[] = sprintf("\t%s = '%s';\n", '$sec', 'section');
			#$to_file[] = sprintf("\t%s['%s'] = %s;\n", '$attr', 'included', 'true');
			
			### content
			$to_file[] = sprintf($header, 'content');
			$to_file[] = sprintf("\trequire_once('%s');\n", 'page-top.php');

			$to_file[] = sprintf("\tswitch (%s['%s']) {\n", '$attr', 'part');
			$to_file[] = sprintf("\t\tcase '':\n");
			$to_file[] = sprintf("\t\t\trequire_once(%s);\n",
				function_file('body', $unique, false));
			$to_file[] = sprintf("\t\t\t%s (%s, %s, %s);\n",
				function_name('body', $prefix, false), '$attr', '$sec', 'true');
			$to_file[] = sprintf("\t\t\tbreak;\n");
			if (count($this->body) > 1 || $this->body[0]->getName()) foreach ($this->body as $_) {
				$to_file[] = sprintf("\t\tcase '%s':\n", $_->getName());
				$to_file[] = sprintf("\t\t\trequire_once(%s);\n",
					function_file('tab', $unique, $_->getName()));
				$to_file[] = sprintf("\t\t\t%s (%s, %s, %s);\n",
					function_name('tab', $prefix, $_->getName()), '$attr', '$sec', 'true');
				$to_file[] = sprintf("\t\t\tbreak;\n");
			}
			$to_file[] = sprintf("\t\tdefault: require('runtime-error.php');\n");
			$to_file[] = sprintf("\t}\n");

			$to_file[] = sprintf("\trequire_once('%s');\n", 'page-middle.php');
			$to_file[] = sprintf("\trequire_once(%s);\n",
				function_file('side', $unique, false));
			$to_file[] = sprintf("\t%s (%s, %s, %s);\n",
				function_name('side', $prefix, false),
				'$attr', '$sec', 'true');
			$to_file[] = sprintf("\trequire_once('%s');\n", 'page-bottom.php');
			
			$to_file[] = sprintf("} %s%s\n", '?', '>');

			file_put_contents($target_file, $to_file);
			return;
		}

		private function write_tab_file ($target, $unique)
		{
			if (count($this->body) < 2 && !$this->body[0]->getName()) return;

			$prefix = underscore($unique);

			foreach ($this->body as $_)
			{
				$to_file = array();
				$target_file = sprintf('%stab-%s.php', $target, $_->getName());
				#printf("\tPutting tab content into [%s]\n", $target_file);

				$to_file[] = sprintf("%s%s function %s (%s, %s, %s) { %s%s\n",
					'<', '?php', 
					function_name('tab', $unique, $_->getName()),
					'$attr','$sec', '$standalone', '?', '>');
				$to_file[] = $_->getContent(true);
				$to_file[] = sprintf("%s%s } %s%s\n", '<', '?php', '?', '>');

				file_put_contents($target_file, $to_file);
			}
		}

		public function deploy ($target, $unique)
		{
			$this->link_tabs();
			$this->write_side_file($target, $unique);
			$this->write_content_file($target, $unique);
			$this->write_page_file($target, $unique);
			$this->write_tab_file($target, $unique);
			return;
		}
	}
?>
