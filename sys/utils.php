<?php

	function make_canonical ($attr, $url, $tab=false, $hash=false)
	{
		if ($tab) $result = substr($url, 0, -1).'§'.strtoupper($tab).'/';
		else $result = $url;
		if ($attr['theme'] != 'gray') $result .= 'White/';
		if ($attr['tabs'] != 'singletab') $result .= 'AllTabs/';
		if ($hash) $result .= '#'.$hash;
		return $result;
	}
	
	function make_tid($attr, $current, $url, $tab, $title)
	{
		if ($attr['tabs'] == 'singletab') {
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

?>
