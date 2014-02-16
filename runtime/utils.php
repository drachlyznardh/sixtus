<?php

	function make_canonical ($attr, $url, $tab=false, $hash=false)
	{
		if ($tab) $result = substr($url, 0, -1).'§'.mb_strtoupper($tab, 'UTF-8').'/';
		else $result = $url;
		if (!$attr['gray']) $result .= 'White/';
		if (!$attr['single']) $result .= 'All/';
		if ($hash) $result .= '#'.$hash;
		return $result;
	}
	
	function make_tid($attr, $title, $tab, $hash)
	{
		$url = false;
		
		if ($attr['single'] && !$attr['force_all_tabs']) {
			if ($attr['part'] == $tab) {
				if ($hash) $url = make_canonical ($attr, $attr['self'], $tab, $hash);
			} else {
				if ($hash) $url = make_canonical ($attr, $attr['self'], $tab, $hash);
				else $url = make_canonical ($attr, $attr['self'], $tab);
			}
		} else {
			$url = make_canonical ($attr, $attr['self'], false, mb_strtoupper($tab, 'UTF-8'));
		}
		
		if ($url) return '<a href="'.$url.'">'.$title.'</a>';
		return '<em>'.$title.'</em>';
	}

	function make_next($attr, $name, $standalone)
	{
		if (!$standalone) return;
		
		$result[] = '<div class="section"><p class="reverse">';
		$result[] = sprintf('Continua nel %s tab.',
			make_tid($attr, 'prossimo', $name, false));
		$result[] = '</p></div>';
		
		printf(implode($result));
	}

	function make_prev($attr, $name, $standalone)
	{
		if (!$standalone) return;
		
		$result[] = '<div class="section"><p>';
		$result[] = sprintf('Continua dal tab %s.',
			make_tid($attr, 'precendente', $name, false));
		$result[] = '</p></div>';
		
		printf(implode($result));
	}

	function dynamic_include ($attr, $filename, $part, $sections)
	{
		$attr['included'] = true;
		$attr['sections'] = $sections;
	
		switch($part)
		{
			case '':
			case 'page':
				$attr['part'] = 'page';
				$attr['force_all_tabs'] = true;
				break;
			case 'side':
				$attr['part'] = 'side';
				$attr['force_all_tabs'] = false;
				break;
			default:
				$attr['part'] = $part;
				$attr['force_all_tabs'] = false;
		}

		require($filename);	
	}

	function require_all ($attr, $target)
	{
		require(docroot().$target);
		$target_dir = docroot().dirname($target);
		$s = false;
		foreach ($c as $_) require ("$target_dir/tab-$_.php");
	}

	function require_one ($attr, $target)
	{
		$s = false;
		require(docroot().$target);
	}

	function search_for_dir ($map, $attr, $path)
	{
		$short = false;
		$limit = count($path) - 1;
		for ($i = 0; $i < $limit; $i++) $short .= ucwords($path[$i]).'/';
		$long = $short.ucwords($path[$limit]).'/';

		if (preg_match('/blog/', $path[0]))
		{
			$target = sprintf("%s", mb_strtolower($long), 'UTF-8');
		}
		else if (isset($map[$long]))
		{
			#printf ("Found [%s] Long\n", $long);
			$target = sprintf("%s/", mb_strtolower($map[$long], 'UTF-8'));
		}
		else if (isset($map[$short]))
		{
			#printf ("Found [%s] Short\n", $short);
			$target = sprintf("%s/%s/",
				mb_strtolower($map[$short], 'UTF-8'), $path[$limit]);
		}
		else $target = false;

		#printf("Short[%s], Long[%s], Target[%s]", $short, $long, $target);
		return $target;
	}

	function extract_heading_path ($attr, $request, $part, $map)
	{
		$previous = false;
		$address = false;
		$limit = count($request);
		for ($i = 0; $i < $limit; $i++)
		{
			$title = ucwords($request[$i]);
			$previous = $address;
			$address .= $title.'/';
			$tmp = $address;
			$missing = true;

			if (isset($map[$tmp]))
			{
				$missing = false;
				$canon = make_canonical($attr, $address, false, false);
				$result['cat'][$i] = array($title, $canon);
				#printf(' / <a href="%s">%s</a>', $canon, $title);
			}
			else for ($j = $i + 1; $j < $limit; $j++)
			{
				$tmp .= ucwords($request[$j]).'/';
				if (isset($map[$tmp])) {
					$missing = false;
					$canon = make_canonical($attr, $tmp, false, false);
					$result['cat'][$i] = array($title, $canon);
					#printf(' / <a href="%s">%s</a>', $result['cat'][$i][1], $title);
					break;
				}
			}

			if ($missing) {
				$TITLE = mb_strtoupper($title, 'UTF-8');
				$previous .= $TITLE.'/';
				$canon = make_canonical($attr, $previous, false, false);
				$result['page'] = array($TITLE, $canon);
				#printf(' / <a href="%s">%s</a>', $TITLE, $canon);
			} else $result['page'] = false;
		}

		if ($part) {
			$PART = mb_strtoupper($part, 'UTF-8');
			$canon = make_canonical($attr, $previous, $PART, false);
			$result['part'] = array($PART, $canon);
		} else $result['part'] = false;

		return $result;
	}

	function find_self($heading)
	{
		if ($heading['page']) return $heading['page'][1];
		
		$limit = count($heading['cat']) - 1;
		return $heading['cat'][$limit][1];
	}

	function display_heading_server ($server)
	{
		$servername = $_SERVER['HTTP_HOST'];
		if (isset($server[$servername])) $target = $server[$servername];
		else $target = array($servername => 'http://'.$servername);
		
		foreach (array_keys($target) as $_)
			$output[] = sprintf('<a href="%s">%s</a>', $target[$_], $_);

		printf(implode(' . ', $output));
	}

	function display_heading_path ($heading)
	{
		foreach ($heading['cat'] as $_)
			printf(' / <a href="%s">%s</a>', $_[1], $_[0]);
	}

	function display_heading_page ($heading)
	{
		if ($heading['page'])
			printf(' / <a href="%s">%s</a>', $heading['page'][1], $heading['page'][0]);
		if ($heading['part'])
			printf(' § <a href="%s">%s</a>', $heading['part'][1], $heading['part'][0]);
	}
	
	function load_page_title ($target)
	{
		require_once(docroot().strtolower($target).'meta.php');
		return array(false, $target, $p['short'], false);
	}

	function parse_related ($rel)
	{
		if (preg_match('/@/', $rel[1])) {
			$_ = preg_split('/@/', $rel[1]);
			switch(count($_))
			{
				case 2: $bf = false; $title = $_[0]; $af = $_[1]; break;
				case 3: $bf = $_[0]; $title = $_[1]; $af = $_[2]; break;
			}
		} else {
			$bf = $af = false;
			$title = $rel[1];
		}
		return array($bf, $rel[1], $title, $af);
	}
?>
