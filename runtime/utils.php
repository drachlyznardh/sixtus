<?php

	function make_canonical ($attr, $url, $tab=false, $hash=false)
	{
		if ($tab) $result = substr($url, 0, -1).'§'.strtoupper($tab).'/';
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
			if ($attr['current'] == $tab) {
				if ($hash) $url = make_canonical ($attr, $attr['self'], $tab, $hash);
			} else {
				if ($hash) $url = make_canonical ($attr, $attr['self'], $tab, $hash);
				else $url = make_canonical ($attr, $attr['self'], $tab);
			}
		} else {
			$url = make_canonical ($attr, $attr['self'], false, strtoupper($tab));
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

	function tab_condition ($attr, $name)
	{
		if ($attr['included'])
			return $attr['part'] == 'page' or
					$attr['part'] == $name;
		else
			return !$attr['single'] or
					$attr['part'] == $name or
					($attr['part'] == false and $attr['all_or_one']) or
					$attr['force_all_tabs'];
	}

	function side_condition ($attr)
	{
		if ($attr['included']) return $attr['part'] == 'side';
		else return true;
	}

	function tabrel_condition ($attr)
	{
		return $attr['single'] && !$attr['included'] && !$attr['all_or_one'];
	}

	function get_tag_filename ($tag)
	{
		switch(strlen($tag))
		{
			case 1:
				$target = sprintf('%s.php', $tag[0]);
				break;
			case 2:
				$target = sprintf('%s/%s.php', $tag[0], $tag);
				break;
			default:
				$target = sprintf('%s/%s%s/%s.php', $tag[0], $tag[0], $tag[1], $tag);
				break;
		}
		#printf("Tag[%s] lives in %s\n", $tag, $target);
		return $target;
	}

	function include_search_form ()
	{
		echo ('<input type="text" name="query" value="" placeholder="Search" />');
	}

	function get_GET_parameters ()
	{
		$query = urldecode(strtolower($_SERVER['REQUEST_URI']));
		$index = strpos($query, '?');
		$query = substr($query, $index + 1);

		foreach (split('&', $query) as $_)
		{
			$param = split('=', $_);

			if (count($param) == 1) $data[$param[0]] = $param[0];
			else $data[$param[0]] = $param[1];
		}

		return $data;
	}

	function get_filename_from_tag ($tagname)
	{
		$tagname = strtolower($tagname);
		
		if (strlen($tagname) == 1) return $tagname[0].'/'.$tagname.'.tag';
		else return $tagname[0].'/'.$tagname[0].$tagname[1].'/'.$tagname.'.tag';
	}

	function count_tags ($filename)
	{
		echo ("<p>[$filename]</p><br/>");
		$rows = file($filename);
		foreach($rows as $row) echo ("<p>$row</p>");
		
		include ($filename);
		return count($tag);
	}
	
	function include_search_cloud ($attr)
	{
		require_once('db/cloud.php');
		ksort($cloud);
		
		printf ('<div id="cloud"><p>');
		foreach(array_keys($cloud) as $key)
			printf ('%s<span style="%s"><a href="%s?query=%s">%s</a></span>',
				"\n",
				sprintf('font-size: %dpx', 11 + 4*ceil(log($cloud[$key], 2))),
				make_canonical($attr, 'Tag/', false, false),
				$key, ucwords($key));
		printf ('%s</p></div>', "\n");
		return;
	}

	function include_search_static ($attr, $tagname)
	{
		$tag = array();
		$dbfile = 'db/'.get_tag_filename($tagname);
		printf("<p>Tag [%s] file [%s]</p>\n", $tagname, $dbfile);
		if (file_exists($dbfile)) include($dbfile);

		echo ('<h3 class="reverse">Risultati per [');
		echo ('<a href="'.make_canonical($attr, '/Tag/', false, false).'?query='.$tagname.'">'.ucwords($tagname).'</a>');
		echo (']:</h3>');
		
		if (count($tag) < 1) {
			echo ('<p>Nessun risultato.</p>');
			return;
		}
		
		echo ('<ul>');
		foreach (array_keys($tag) as $_)
			foreach (array_keys($tag[$_]) as $__)
			{
				if (strcmp($__, 'page') == 0) $tab = false;
				else $tab = $__;
				$href = make_canonical($attr, $_, $tab, false);
				
				echo ('<li><a href="'.$href.'">'.$tag[$_][$__].'</a></li>');
			}
		echo ('</ul>');
	}

	function include_search_result ($attr)
	{
		$result = array();
		$param = get_GET_parameters();
	
		if (count($param) == 0) return;
		if (!isset($param['query'])) return;
		if (strlen($param['query']) == 0) return;

		foreach (split('[ \+]', $param['query']) as $_)
		{
			$dbfile = 'db/'.get_tag_filename($_);
			if (file_exists($dbfile))
			{
				$tag = array();
				include($dbfile);
				$result[$_] = $tag;
			}
		}

		if (count($result) == 0)
		{
			echo ('<h3 class="reverse">Sorry</h3>');
			echo ('<p>No match found.</p>');
			return;
		}

		foreach(array_keys($result) as $current)
		{
			echo ('<h3 class="reverse">Risultati per [');
			echo ('<a href="'.make_canonical($attr, '/Tag/', false,
			false).'?query='.$current.'">'.ucwords($current).'</a>');
			echo(']:</h3><ul>');
			foreach (array_keys($result[$current]) as $_)
				foreach (array_keys($result[$current][$_]) as $__)
				{
					if (strcmp($__, 'page') == 0) $tab = false;
					else $tab = $__;
					$href = make_canonical($attr, $_, $tab, false);
					
					echo ('<li><a href="'.$href.'">'.$result[$current][$_][$__].'</a></li>');
				}
			echo ('</ul>');
		}
	}
?>
