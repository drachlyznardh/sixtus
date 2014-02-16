<?php

	function polish_line ($_)
	{
		$_ = preg_replace('/@SHARP@/', '#', $_);
		$_ = preg_replace('/@AT@/', '&#64;', $_);
		$_ = preg_replace('/\'/', '&apos;', $_);

		return $_;
	}

	function fail ($m, $f, $l)
	{
		printf("Error in %s @%04d: %s\n", $f, $l, $m);
		exit(1);
	}

	function check_line_format ($line, $i)
	{
		$pattern ='/^([0-9]+) ([0-9]+) (.*)$/'; 

		if (!preg_match($pattern, $line))
			fail("Wrong format", $argv[1], $i);
	
		$f = preg_replace($pattern, '$1', $line);
		$l = preg_replace($pattern, '$2', $line);
		$s = preg_replace($pattern, '$3', $line);

		return array($f, $l, $s);
	}

	function split_line_content ($line)
	{
		if (preg_match('/^#/', $line))
			return array(false, false, array(false));
		if (!preg_match('/#/', $line))
			return array(false, false, array($line));

		$t = split('#', $line);
		$u = split('@', $t[0]);
		return array($u[0], $u, $t);
	}

?>
