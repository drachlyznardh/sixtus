<?php

	class Parser {
	
		private $pstate = 'meta';

		private $title = '__TITLE__';
		private $subtitle = '__SUBTITLE__';
		private $keywords = '__KEYWORDS__';

		private $prev = array('__PREV_0__', '__PREV_1__');
		private $next = false;

		private $current = null;
		private $body = array();
		private $side = array();

		public function __construct()
		{
			$this->current = new Tab();
		}

		public function parse($filename)
		{
			$index = 0;
			$rows = file ($filename, FILE_IGNORE_NEW_LINES);

			foreach ($rows as $_) {
				$index++;
				if (preg_match('/^#.*/', $_)) {
					#printf("\tLine#$index is a comment\n");
				} else if (preg_match('/#/', $_)) {
					$fragment = split('#', trim($_));
					if (preg_match('/@/', $fragment[0])) {
						$cmd_attr = split('@', $fragment[0]);
						$command = $cmd_attr[0];
					} else $command = $cmd_attr = $fragment[0];
					#printf("\tLine#$index has a [$command] command\n");

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
				} else {
					#printf("\tLine#$index has no command: [$_]\n");
					$_ = preg_replace('/@SHARP@/', '#', $_);
					$_ = preg_replace('/\'/', '&apos;', $_);
					$_ = preg_replace('/"/', '&quot;', $_);
					$this->current->parse($index, '', '', array($_));
				}
			}
		}

		private function parse_meta ($lineno, $cmd, $cmd_attr, $cmd_par)
		{
			switch($cmd) {
				case 'title':
					switch(count($cmd_par)){
						case 3:
							$this->subtitle = $cmd_par[2];
						case 2:
							$this->title = $cmd_par[1];
							break;
					}
					break;
				case 'subtitle':
					$this->subtitle = $cmd_par[1];
					break;
				case 'keywords':
					$this->keywords = $cmd_par[1];
					break;
				case 'prev':
					$this->prev = array($cmd_par[1], $cmd_par[2]);
					break;
				case 'next':
					$this->next = array($cmd_par[1], $cmd_par[2]);
					break;
				case 'start':
					switch($cmd_par[1]) {
						case 'page':
							$this->pstate = 'body';
							break;
						case 'side':
							$this->pstate = 'side';
							break;
					}
					break;
			}
		}

		private function parse_side ($lineno, $cmd, $cmd_attr, $cmd_args)
		{
			switch ($cmd) {
				case 'stop':
					$this->pstate = 'meta';
					$this->side[] = $this->current;
					$this->current = new Tab();
					break;
				default:
					$this->current->parse($lineno, $cmd, $cmd_attr, $cmd_args);
			}
		}

		private function parse_body ($lineno, $cmd, $cmd_attr, $cmd_args)
		{
			switch ($cmd) {
				case 'stop':
					$this->pstate = 'meta';
					$this->body[] = $this->current;
					$this->current = new Tab();
					break;
				default:
					$this->current->parse($lineno, $cmd, $cmd_attr, $cmd_args);
			}
		}

		public function deploy ()
		{
			printf("<?php\n");
			printf("\n");
			printf("\t\$attr['title'] = '$this->title';\n");
			printf("\t\$attr['subtitle'] = '$this->subtitle';\n");
			printf("\t\$attr['keywords'] = '$this->keywords';\n");
			printf("\n");
			if ($this->prev)
				printf("\t\$related['prev'] = array('".$this->prev[0]."', '".$this->prev[1]."');\n");
			else printf("\t\$related['prev'] = false;\n");
			if ($this->next)
				printf("\t\$related['next'] = array('".$this->next[0]."', '".$this->next[1]."');\n");
			else printf("\t\$related['next'] = false;\n");
			printf("\n");
			printf("\trequire_once('sys/fragments/in-before.php');\n");
			foreach ($this->body as $_) {
				printf("?>\n");
				printf("<!--[Body/Start]-->\n");
				printf($_->getContent());
				printf("<!--[Body/Stop]-->\n");
				printf("<?php \n");
			}
			printf("\trequire_once('sys/fragments/in-middle.php');\n");
			foreach ($this->side as $_) {
				printf("?>\n");
				printf("<!--[Side/Start]-->\n");
				printf($_->getContent());
				printf("<!--[Side/Stop]-->\n");
				printf("<?php \n");
			}
			printf("\trequire_once('sys/fragments/in-after.php');\n");
			printf("?>\n");
		}
	}
?>
