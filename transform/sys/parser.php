<?php

	function polish_line ($_)
	{
		$_ = preg_replace('/@SHARP@/', '#', $_);
		$_ = preg_replace('/@AT@/', '&#64;', $_);
		$_ = preg_replace('/\'/', '&apos;', $_);

		return $_;
	}

	class Parser {
	
		private $pstate;

		private $prefix;

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

		public function parse($filename)
		{
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
					switch ($this->pstate) {
						case 'meta':
							$this->parse_meta($index, $command, $cmd_attr, $fragment);
							break;
						case 'side':
							$this->parse_side($index, $command, $cmd_attr, $fragment);
							break;
						case 'body':
							$this->parse_body($index, $command, $cmd_attr, $fragment);
							break;
					}
				} else if ($this->pstate != 'meta') {
					$this->current->parse($index, '', '', array(polish_line($_)));
				}
			}
		}

		private function parse_meta ($lineno, $cmd, $cmd_attr, $cmd_par)
		{
			switch($cmd) {
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
				case 'start':
					switch($cmd_par[1]) {
						case 'page':
							$this->pstate = 'body';
							$this->current = new Tab();
							break;
						case 'side':
							$this->pstate = 'side';
							$this->current = new Tab();
							break;
					}
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
			}
		}

		private function parse_side ($lineno, $cmd, $cmd_attr, $cmd_args)
		{
			switch ($cmd) {
				case 'stop':
					$this->pstate = 'meta';
					$this->current->closeTab();
					$this->side[] = $this->current;
					$this->current = null;
					break;
				case 'include': $this->make_include($cmd_args); break;
				default:
					$this->current->parse($lineno, $cmd, $cmd_attr, $cmd_args);
			}
		}

		private function parse_body ($lineno, $cmd, $cmd_attr, $cmd_args)
		{
			switch ($cmd) {
				case 'stop':
					$this->pstate = 'meta';
					$this->current->closeTab();
					$this->body[] = $this->current;
					$this->current = null;
					break;
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
				case 'include': $this->make_include($cmd_args); break;
				case 'require':
					$this->current->make_require($cmd_attr[1], $cmd_args[1]);
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
			if (count($attr) < 2 || strcmp($attr[1], 'static') != 0) return;
		
			if (preg_match('/\.s?lyz$/', $args[1])) 
				$filename = $args[1];
			else if (preg_match('/\.pag$/', $args[1]))
				$filename = $args[1];
			else $filename = $args[1].'.lyz';

			if (is_file($filename)) $includefile = $filename;
			else {
				$includefile = $this->include_base.'/'.$filename;
				if (!is_file($includefile))
				{
					$includefile = $this->prefix.'/'.$filename;
					if (!is_file($includefile)) 
						die ("Cannot locate [$filename], from [$this->include_base] nor from [$this->prefix]\n");
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

		private function deploy_body()
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
			foreach ($this->body as $_)
				printf("%s", $_->getContent(true));
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

		private function deploy_one_tab($target_file, $unique)
		{
			#printf("With no tabs, it goes into [%s]\n", $target_file);

			$to_file[] = sprintf("%s%s\n\n", '<', '?php');

			### Unique function
			$unique_fun_name = sprintf('%s', str_replace('/', '_', $unique));
			$to_file[] = sprintf("\tfunction %s (%s, %s) {%s%s\n",
				$unique_fun_name, '$attr', '$sec', '?', '>');
			$to_file[] = $this->body[0]->getContent(true);
			$to_file[] = sprintf("%s%s }\n\n", '<', '?php');
			### Unique function

			### Unique side function
			$unique_fun_name = sprintf('%s', str_replace('/', '_', $unique));
			$to_file[] = sprintf("\tfunction %s_side (%s, %s) {%s%s\n",
				$unique_fun_name, '$attr', '$sec', '?', '>');
			foreach ($this->side as $_)
				$to_file[] = $_->getContent(true);
			$to_file[] = sprintf("%s%s }\n\n", '<', '?php');
			### Unique side function

			### Calling unique function
			$to_file[] = sprintf("\tif(!%s['%s'])\n\t{\n",
				'$attr', 'included');
			$to_file[] = $this->deploy_attr();
			$to_file[] = sprintf("\n");
			$to_file[] = sprintf("\t\t%s = '%s';\n", '$sec', 'section');
			$to_file[] = sprintf("\t\trequire_once('page-top.php');\n");
			$to_file[] = sprintf("\t\t%s(%s, %s);\n",
				$unique_fun_name, '$attr', '$sec');
			$to_file[] = sprintf("\t\trequire_once('page-middle.php');\n");
			$to_file[] = sprintf("\t\t%s_side(%s, %s);\n",
				$unique_fun_name, '$attr', '$sec');
			$to_file[] = sprintf("\t\trequire_once('page-bottom.php');\n");
			$to_file[] = sprintf("\t}\n");
			### Calling unique function

			$to_file[] = sprintf("\n%s%s\n", '?', '>');

			file_put_contents($target_file, $to_file);
			return;
		}

		private function deploy_tab($target_dir, $target, $unique)
		{
			$target_file = sprintf("%s/%s.php", $target_dir, $target->getName());
			#printf("Tab[%s] goes into [%s]\n", $target->getName(), $target_file);

			$to_file[] = sprintf("%s%s\n\n", '<', '?php');

			### Unique function
			$unique_fun_name = sprintf('%s_%s', str_replace('/', '_', $unique), $target->getName());
			$to_file[] = sprintf("\tfunction %s (%s, %s) {%s%s\n",
				$unique_fun_name, '$attr', '$sec', '?', '>');
			$to_file[] = $target->getContent(true);
			$to_file[] = sprintf("%s%s }\n\n", '<', '?php');
			### Unique function

			### Calling unique function
			$to_file[] = sprintf("\tif(!%s['%s'])\n\t{\n",
				'$attr', 'included');
			$to_file[] = $this->deploy_attr();
			$to_file[] = sprintf("\n");
			$to_file[] = sprintf("\t\t%s = '%s';\n", '$sec', 'section');
			$to_file[] = sprintf("\t\trequire_once('page-top.php');\n");
			$to_file[] = sprintf("\t\t%s(%s, %s);\n",
				$unique_fun_name, '$attr', '$sec');
			$to_file[] = sprintf("\t\trequire_once('page-middle.php');\n");
			$to_file[] = sprintf("\t\trequire_once(%s['%s'].'%s.d/%s');\n",
				'$_SERVER', 'DOCUMENT_ROOT', $unique, 'right-side.php');
			$to_file[] = sprintf("\t\trequire_once('page-bottom.php');\n");
			$to_file[] = sprintf("\t}\n");
			$to_file[] = sprintf("\n%s%s\n", '?', '>');
			### Calling unique function

			file_put_contents($target_file, $to_file);
			return;
		}

		private function deploy_right_side($target_dir)
		{
			$target_file = sprintf("%s/%s.php", $target_dir, 'right-side');
			#printf("Side file goes into [%s]\n", $target_file);
			
			foreach ($this->side as $_)
				$to_file[] = $_->getContent(false);
			
			file_put_contents($target_file, $to_file);
			return;
		}

		public function deploy_page ($target_file, $unique)
		{
			#printf("Page file goes into [%s]\n", $target_file);

			$to_file[] = sprintf("%s%s\n\n", '<', '?php');

			### Unique function
			$unique_fun_name = sprintf('%s', str_replace('/', '_', $unique));
			$to_file[] = sprintf("\tfunction %s (%s, %s)\n\t{\n",
				$unique_fun_name, '$attr', '$sec');
			$to_file[] = sprintf("\t\t%s['%s'] = %s;\n", '$attr', 'included', 'true');
			foreach ($this->body as $_)
			{
				$to_file[] = sprintf("\t\t%s(%s['%s'].'%s.d/%s.php');\n",
					'require_once', '$_SERVER', 'DOCUMENT_ROOT',
					$unique, $_->getName());
				$to_file[] = sprintf("\t\t%s_%s(%s, %s);\n",
					$unique_fun_name, $_->getName(), '$attr', '$sec');
			}
			$to_file[] = sprintf("\t}\n\n");
			### Unique function

			### Calling unique function
			$to_file[] = sprintf("\tif(!%s['%s'])\n\t{\n",
				'$attr', 'included');
			$to_file[] = $this->deploy_attr();
			$to_file[] = sprintf("\n");
			$to_file[] = sprintf("\t\t%s = '%s';\n", '$sec', 'section');
			$to_file[] = sprintf("\t\trequire_once('page-top.php');\n");
			$to_file[] = sprintf("\t\t%s(%s, %s);\n",
				$unique_fun_name, '$attr', '$sec');
			$to_file[] = sprintf("\t\trequire_once('page-middle.php');\n");
			$to_file[] = sprintf("\t\trequire_once(%s['%s'].'%s.d/%s');\n",
				'$_SERVER', 'DOCUMENT_ROOT', $unique, 'right-side.php');
			$to_file[] = sprintf("\t\trequire_once('page-bottom.php');\n");
			$to_file[] = sprintf("\t}\n");
			$to_file[] = sprintf("\n%s%s\n", '?', '>');
			### Calling unique function

			file_put_contents($target_file, $to_file);
			return;
		}

		private function write_side_file ($target, $unique)
		{
			$target_file = sprintf('%sright-side.php', $target);
			printf("\tPutting side content into [%s]\n", $target_file);
		
			$to_file[] = sprintf("%s%s function %s_right_side (%s, %s) { %s%s\n",
				'<', '?php', str_replace('/', '_', $unique), '$attr', '$sec', '?', '>');
			foreach($this->side as $_)
				$to_file[] = $_->getContent(false);
			$to_file[] = sprintf("%s%s } %s%s\n", '<', '?php', '?', '>');

			file_put_contents($target_file, $to_file);
			return;
		}

		private function write_content_file ($target, $unique)
		{
			$target_file = sprintf('%scontent.php', $target);
			printf("\tPutting content into [%s]\n", $target_file);
		
			if (count($this->body) > 1)
			{
				$to_file[] = sprintf("%s%s function %s_content (%s, %s) {\n",
					'<', '?php', str_replace('/', '_', $unique), '$attr', '$sec');
				foreach($this->body as $_)
				{
					$to_file[] = sprintf("\trequire_once(%s['%s'].'%stab-%s.php');\n",
						'$_SERVER', 'DOCUMENT_ROOT', $unique, $_->getName());
					$to_file[] = sprintf("\t%s_%s (%s, %s);\n",
						str_replace('/', '_', $unique), $_->getName(), '$attr', '$sec');
				}
				$to_file[] = sprintf("} %s%s\n", '?', '>');
			}
			else
			{
				$to_file[] = sprintf("%s%s function %s_content (%s, %s) { %s%s\n",
					'<', '?php', str_replace('/', '_', $unique), '$attr', '$sec', '?', '>');
				$to_file[] = $this->body[0]->getContent(true);
				$to_file[] = sprintf("%s%s } %s%s\n", '<', '?php', '?', '>');
			}

			file_put_contents($target_file, $to_file);
			return;
		}

		private function write_page_file ($target, $unique)
		{
			$header = "\n\t### %s\n";
			$prefix = str_replace('/', '_', $unique);
			$target_file = sprintf('%spage.php', $target);
			printf("\tPutting page data into [%s]\n", $target_file);
		
			$to_file[] = sprintf("%s%s if (!%s['%s']) {\n",
				'<', '?php', '$attr', 'included');
			
			### data
			$to_file[] = sprintf($header, 'data');
			$to_file[] = $this->deploy_attr();
			
			### settings
			$to_file[] = sprintf($header, 'settings');
			$to_file[] = sprintf("\t%s = '%s';\n", '$sec', 'section');
			$to_file[] = sprintf("\t%s['%s'] = %s;\n", '$attr', 'included', 'true');
			
			### content
			$to_file[] = sprintf($header, 'content');
			$to_file[] = sprintf("\trequire_once('%s');\n", 'page-top.php');
			$to_file[] = sprintf("\trequire_once(%s['%s'].'%s/content.php');\n",
				'$_SERVER', 'DOCUMENT_ROOT', $unique);
			$to_file[] = sprintf("\t%s_content (%s, %s);\n", $prefix, '$attr', '$sec');
			$to_file[] = sprintf("\trequire_once('%s');\n", 'page-middle.php');
			$to_file[] = sprintf("\trequire_once(%s['%s'].'%s/right-side.php');\n",
				'$_SERVER', 'DOCUMENT_ROOT', $unique);
			$to_file[] = sprintf("\t%s_right_side (%s, %s);\n", $prefix, '$attr', '$sec');
			$to_file[] = sprintf("\trequire_once('%s');\n", 'page-bottom.php');
			
			$to_file[] = sprintf("} %s%s\n", '?', '>');

			file_put_contents($target_file, $to_file);
			return;
		}

		public function deploy ($target, $unique)
		{
			$this->write_side_file($target, $unique);
			$this->write_content_file($target, $unique);
			$this->write_page_file($target, $unique);
			return;
			
			if (count($this->body) > 1)
			{
				$this->link_tabs();
				foreach ($this->body as $_)
					$this->deploy_tab($target_dir, $_, $unique);
				$this->deploy_right_side($target_dir);
				$this->deploy_page($target_file, $unique);
			}
			else
			{
				$this->deploy_one_tab($target_file, $unique);
			}
		}
	}
?>
