<?php

	function make_canonical ($attr, $url, $tab=false)
	{
		if ($tab) $result = substr($url, 0, -1).'§'.strtoupper($tab).'/';
		else $result = $url;
		if ($attr['style'] != 'gray') $result .= 'White/';
		if ($attr['tabs'] != 'singletab') $result .= 'AllTabs/';
		return $result;
	}

?>
