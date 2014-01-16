<div class="section">
<?php
	function display_heading_server ()
	{
		foreach (explode('.', $_SERVER['HTTP_HOST']) as $_)
			printf('[%s]', $_);
	}

	function heading_path ($attr, $request, $part, $map)
	{
		$previous = false;
		$address = false;
		$limit = count($request);
		for ($i = 0; $i < $limit; $i++)
		{
			$title = ucwords($request[$i]);
			$previous = $address;
			$address .= $title.'/';
			$tmp = $address;
			$missing = true;

			if (isset($map[$tmp]))
			{
				$missing = false;
				$canon = make_canonical($attr, $address, false, false);
				$result['cat'][$i] = array($title, $canon);
				#printf(' / <a href="%s">%s</a>', $canon, $title);
			}
			else for ($j = $i + 1; $j < $limit; $j++)
			{
				$tmp .= ucwords($request[$j]).'/';
				if (isset($map[$tmp])) {
					$missing = false;
					$canon = make_canonical($attr, $tmp, false, false);
					$result['cat'][$i] = array($title, $canon);
					#printf(' / <a href="%s">%s</a>', $result['cat'][$i][1], $title);
					break;
				}
			}

			if ($missing) {
				$TITLE = strtoupper($title);
				$previous .= $TITLE.'/';
				$canon = make_canonical($attr, $previous, false, false);
				$result['page'] = array($TITLE, $canon);
				#printf(' / <a href="%s">%s</a>', $TITLE, $canon);
			} else $result['page'] = false;
		}

		if ($part) {
			$PART = strtoupper($part);
			$canon = make_canonical($attr, $previous, $PART, false);
			$result['part'] = array($PART, $canon);
		} else $result['part'] = false;

		return $result;
	}

	function heading_part ($attr, $request, $part, $map)
	{
		if (!$part) return;

		$previous = false;
		$current = false;
		$limit = count($request);
		for ($i = 0; $i < $limit; $i++)
		{
			$previous = $current;
			$current .= ucwords($request[$i]);
		}

			printf(' § <a href="%s">%s</a>',
				make_canonical($attr, implode('/', $request).'/', $part, false), strtoupper($part));
	}

	function display_heading_path ($heading)
	{
		foreach ($heading['cat'] as $_)
			printf(' / <a href="%s">%s</a>', $_[1], $_[0]);
	}

	function display_heading_page ($heading)
	{
		if ($heading['page'])
			printf(' / <a href="%s">%s</a>', $heading['page'][1], $heading['page'][0]);
		if ($heading['part'])
			printf(' § <a href="%s">%s</a>', $heading['part'][1], $heading['part'][0]);
	}
	
	$heading = heading_path($attr, $request['path'], $attr['part'], $direct);
?>
	<div class="inside em">
		<p style="text-align:center"><?php
	display_heading_server();
		?><br class="small-screen"/><?php
	display_heading_path($heading);
	display_heading_page($heading);
		?> / </p>
	</div>
	<div class="inside em"><p style="text-align:center">
		<a href="http://gods.roundhousecode.com">Gods</a> .
		<a href="http://roundhousecode.com">RoundhouseCode</a> .
		<a href="http://roundhousecode.com">com</a>
		<br class="small-screen"/>
<?php
	$cumulative = array();
	$limit = count($request['path']);
	for ($i = 0; $i < $limit; $i++) {
		$current = ucwords($request['path'][$i]);
		$cumulative[] = $current;
		printf(' / <a href="%s">%s</a>',
			make_canonical($attr, implode('/', $cumulative).'/'), $current);
	}
	if ($attr['part'])
		printf(' § <a href="%s§%s">%s</a>',
			make_canonical($attr, implode('/', $cumulative).'/'),
			strtoupper($attr['part']), strtoupper($attr['part']));
?>
	/ </p></div>
		<h1 style="text-align:center"><?=$attr['title']?></h1>
	<div class="outside em">
		<p style="text-align: center"><?=$attr['subtitle']?></p>
	</div>
</div>
