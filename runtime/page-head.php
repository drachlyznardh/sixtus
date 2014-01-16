<div class="section">
<?php
	function heading_server ()
	{
		foreach (explode('.', $_SERVER['HTTP_HOST']) as $_)
			printf('[%s]', $_);
	}

	function heading_path ($attr, $request, $map)
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
				printf(' / <a href="%s">%s</a>',
					make_canonical($attr, $address, false, false), $title);
			}
			else for ($j = $i + 1; $j < $limit; $j++)
			{
				$tmp .= ucwords($request[$j]).'/';
				if (isset($map[$tmp])) {
					$missing = false;
					printf(' / <a href="%s">%s</a>',
						make_canonical($attr, $tmp, false, false), $title);
					break;
				}
			}

			if ($missing) printf(' / <a href="%s">%s</a>',
				make_canonical($attr, $previous.strtoupper($title).'/', false, false), strtoupper($title));
		}
	}

	function heading_part ($attr, $address, $part)
	{
		if ($part)
			printf(' § <a href="%s§%s">%s</a>',
				make_canonical($attr, implode('/', $address).'/'), strtoupper($part), strtoupper($part));
	}
?>
	<div class="inside em">
		<p style="text-align:center"><?php
	heading_server();
		?><br class="small-screen"/><?php
	heading_path($attr, $request['path'], $direct);
	heading_part($attr, $request['path'], $attr['part']);
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
