<?php

	function make_lines_from_file ($filename)
	{
		return file($filename, FILE_IGNORE_NEW_LINES);
	}

	function make_include_filename ($base, $filename)
	{
		if (preg_match('/\.s?lyz$/', $filename))
			$includename = $filename;
		else $includename = $filename.'.lyz';

		if (is_file($includename)) return $includename;

		$includename = $base.'/'.$includename;
		if (is_file($includename)) return $includename;

		return false;
	}

?>
