<?php

	function get_tag_filename ($tag)
	{
		switch(strlen($tag))
		{
			case 1:
				$target = sprintf('%s.php', $tag[0]);
				break;
			case 2:
				$target = sprintf('%s/%s.php', $tag[0], $tag);
				break;
			default:
				$target = sprintf('%s/%s%s/%s.php', $tag[0], $tag[0], $tag[1], $tag);
				break;
		}
		#printf("Tag[%s] lives in %s\n", $tag, $target);
		return $target;
	}

	function include_search_form ()
	{
		echo ('<input type="text" name="query" value="" placeholder="Search" />');
	}

	function get_GET_parameters ()
	{
		$query = urldecode(mb_strtolower($_SERVER['REQUEST_URI'], 'UTF-8'));
		$index = strpos($query, '?');
		$query = substr($query, $index + 1);

		foreach (split('&', $query) as $_)
		{
			$param = split('=', $_);

			if (count($param) == 1) $data[$param[0]] = $param[0];
			else $data[$param[0]] = $param[1];
		}

		return $data;
	}

	function include_search_cloud ($attr)
	{
		require_once('db/cloud.php');
		ksort($cloud);
		
		printf ('<div id="cloud"><p>');
		foreach(array_keys($cloud) as $key)
			printf ('%s<span style="%s"><a href="%s?query=%s">%s</a></span>',
				"\n",
				sprintf('font-size: %dpx', 11 + 4*ceil(log($cloud[$key], 2))),
				make_canonical($attr, 'Tag/', false, false),
				$key, ucwords($key));
		printf ('%s</p></div>', "\n");
		return;
	}

	function display_search_result ($attr, $query)
	{
		$result = array();
		$excluded = array();
		
		foreach ($query as $_)
		{
			$target_file = 'db/'.get_tag_filename($_);
			if (is_file($target_file)) {
				include($target_file);
				$result[$_] = $tag;
				unset($tag);
			} else $excluded[] = $_;
		}

		if (count($excluded) > 0) {
			printf('<p>%s</p><ul><li>%s</li></ul>',
			'I seguenti tag sono stati esclusi dalla ricerca, in quanto non hanno prodotto alcun risultato.',
			implode('</li><li>', $excluded));
		}

		if (count($result) < 1) return;

		$tagnames = array_keys($result);
		$tagcount = count($tagnames);
		$combined = array_keys($result[$tagnames[0]]);
		foreach ($tagnames as $_)
			$combined = array_intersect($combined, array_keys($result[$_]));
		foreach ($combined as $_)
			foreach (array_keys($result) as $ctag)
				foreach (array_keys($result[$ctag][$_]) as $__)
					$final[$_][$__][$ctag] = true;

		if (isset($final)) {
			foreach (array_keys($final) as $_)
				if (isset($final[$_]['page']))
					foreach (array_keys($final[$_]) as $__)
						foreach (array_keys($final[$_]['page']) as $___)
							$final[$_][$__][$___] = true;

			foreach (array_keys($final) as $_)
				foreach (array_keys($final[$_]) as $__)
					if (count($final[$_][$__]) < $tagcount)
						unset($final[$_][$__]);

			foreach (array_keys($final) as $_)
				if (count($final[$_]) < 1)
						unset($final[$_]);
		}

		$limit = count($tagnames);
		printf('<h3 class="reverse">Risultati per [');
		for($i = 0; $i < $limit; $i++) {
			if ($i) printf(' &amp; ');
			printf('<a href="%s?query=%s">%s</a>',
				make_canonical($attr, 'Tag/', false, false),
				$tagnames[$i], ucwords($tagnames[$i]));
		}
		printf(']</h3>');
		
		if (isset($final)) {
			foreach ($result as $_)
				foreach (array_keys($_) as $__)
					foreach (array_keys($_[$__]) as $___)
						$titles[$__][$___] = $_[$__][$___];

			printf('<ul>');
			foreach (array_keys($final) as $page)
				foreach (array_keys($final[$page]) as $part)
					printf('<li><a href="%s">%s</a></li>',
						make_canonical($attr, $page,
							($part == 'page') ? false : $part,
						false), $titles[$page][$part]);
			printf('</ul>');
		} else printf('<p>Nessun risultato.</p>');
		return;
	}

	function include_search_result ($attr)
	{
		$result = array();
		$param = get_GET_parameters();
	
		if (count($param) == 0) return;
		if (!isset($param['query'])) return;
		if (strlen($param['query']) == 0) return;

		display_search_result($attr, split('[\ +]', $param['query']));
		return;
	}

	function include_search_static ($attr)
	{
		$limit = func_num_args();
		$args = func_get_args();

		for ($i = 1; $i < $limit; $i++)
			$query[] = $args[$i];
		display_search_result($attr, $query);
		return;
	}

?>
