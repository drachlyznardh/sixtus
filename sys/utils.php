<?php

	function make_canonical ($attr, $url)
	{
		$result = $url;
		if ($attr['style'] != 'gray') $result .= 'White/';
		if ($attr['tabs'] != 'singletab') $result .= 'AllTabs/';
		return $result;
	}

?>
