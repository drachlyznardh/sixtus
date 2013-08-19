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
			if ($attr['part'] == $tab) {
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
					$attr['force_all_tabs'];
	}

	function side_condition ($attr)
	{
		if ($attr['included']) return $attr['part'] == 'side';
		else return true;
	}
?>
