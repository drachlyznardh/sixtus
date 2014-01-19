<?php

	function polish_line ($_)
	{
		$_ = preg_replace('/@SHARP@/', '#', $_);
		$_ = preg_replace('/@AT@/', '&#64;', $_);
		$_ = preg_replace('/\'/', '&apos;', $_);

		return $_;
	}

	function underscore ($target)
	{
		return str_replace(array('/', '-', '~'), '_', $target);
	}

	function fail ($message)
	{
		echo ($message);
		exit (1);
	}

	function function_name ($type, $unique, $name)
	{
		switch ($type)
		{
			case 'side';
				$result = sprintf('%s_right_side', underscore($unique));
				break;
			case 'body';
				$result = sprintf('%s_content', underscore($unique));
				break;
			case 'tab';
				$result = sprintf('%s_tab_%s', underscore($unique), underscore($name));
				break;
			case 'ghost';
				$result = sprintf('%s_ghost_%s', underscore($unique), underscore($name));
				break;
		}
		return $result;
	}

	function function_file ($type, $unique, $name)
	{
		switch ($type)
		{
			case 'side';
				$result = sprintf('%s/right-side', $unique);
				break;
			case 'body';
				$result = sprintf('%s/content', $unique);
				break;
			case 'tab';
				$result = sprintf('%s/tab-%s', $unique, $name);
				break;
			case 'ghost';
				$result = sprintf('%s/ghost-%s', $unique, $name);
				break;
		}

		return sprintf("%s.'%s.php'", 'docroot()', $result);
	}

?>
