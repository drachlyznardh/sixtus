<?php

	function make_canonical ($attr, $url, $tab=false, $hash=false)
	{
		if ($tab) $result = substr($url, 0, -1).'§'.strtoupper($tab).'/';
		else $result = $url;
		if (!$attr['gray']) $result .= 'White/';
		if (!$attr['single']) $result .= 'AllTabs/';
		if ($hash) $result .= '#'.$hash;
		return $result;
	}
	
	function make_tid($attr, $title, $tab, $hash)
	{
		$url = false;
		
		if ($attr['single']) {
			if ($attr['part'] == $tab) {
				if ($hash) $url = make_canonical ($attr, $attr['self'], $tab, $hash);
				else $result = '<em>'.$title.'</em>';
			} else {
				if ($hash) $url = make_canonical ($attr, $attr['self'], $tab, $hash);
				else $url = make_canonical ($attr, $attr['self'], $tab);
				$result = '<a href="'.$url.'">'.$title.'</a>';
			}
		} else {
			$url = make_canonical ($attr, $attr['self'], false, strtoupper($tab));
			$result = '<a href="'.$url.'">'.$title.'</a>';
		}
		
		if ($url) return '<a href="'.$url.'">'.$title.'</a>';
		return '<em>'.$title.'</em>';
	}

	function dynamic_include ($attr, $filename, $part, $sections)
	{
		$attr['included'] = true;
		$attr['sections'] = $sections;
		
		switch($part)
		{
			case '':
			case 'page':
				$attr['force_all_tabs'] = true; break;
			case 'side':
				$attr['part'] = 'side'; break;
			default: $attr['part'] = $part;
		}

		require($filename);	
	}

	function tab_condition ($attr, $name)
	{
		printf("\t<!-- [\n");
		print_r($attr);
		print_r($name);
		printf("\n] -->\n");
		
		if ($attr['included'])
			return !$attr['single'] or
					$attr['force_all_tabs'] or
					$attr['part'] == $name;
		else
			return $attr['part'] == $name or
					$attr['force_all_tabs'];
	}

	function side_condition ($attr)
	{
		if ($attr['included']) return $attr['part'] == 'side';
		else return true;
	}
?>
