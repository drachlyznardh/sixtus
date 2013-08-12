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
	
	function make_tid($attr, $current, $url, $tab, $title)
	{
		if ($attr['single']) {
			if ($current == $tab) {
				$result = '<em>'.$title.'</em>';
			} else {
				$url = make_canonical ($attr, $url, $tab);
				$result = '<a href="'.$url.'">'.$title.'</a>';
			}
		} else {
			$url = make_canonical ($attr, $url, false, strtoupper($tab));
			$result = '<a href="'.$url.'">'.$title.'</a>';
		}
		
		return $result;
	}

	function dynamic_include ($filename, $part, $as)
	{
		$attr['included'] = true;
		
		switch($part)
		{
			case '':
			case 'page': $include_page = true; break;
			case 'side': $include_side = true; break;
			default: $request['tab'] = $part;
		}

		require($filename);	
	}

?>
