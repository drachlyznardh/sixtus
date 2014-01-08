<?php

	function load_content($filename)
	{
		require_once($filename);

		if (!isset($map)) die("\$Map is not defined.\n");

		return $map;
	}

	$data = load_content($argv[1]);

	$to_file[] = sprintf("%s%s\n\n", '<', '?php');

	foreach (array_keys($data) as $key)
	{
		$KEY = ucwords($key);
		if (is_array($data[$key]))
		{
			foreach (array_keys($data[$key]) as $kkey)
			{
				$KKEY = ucwords($kkey);
				if (is_array($data[$key][$kkey]))
				{
					foreach (array_keys($data[$key][$kkey]) as $kkkey)
					{
						if ($data[$key][$kkey][$kkkey])
							if ($kkkey) $to_file[] = sprintf("\t%s['%s/%s/%s/'] = '%s';\n",
								'$direct', $KEY, $KKEY, ucwords($kkkey), $data[$key][$kkey][$kkkey]);
							else $to_file[] = sprintf("\t%s['%s/%s/'] = '%s'\n",
								'$direct', $KEY, $KKEY, $data[$key][$kkey][$kkkey]);
					}
				}
				else
				{
					if ($data[$key][$kkey])
						if ($kkey) $to_file[] = sprintf("\t%s['%s/%s/'] = '%s';\n",
							'$direct', $KEY, $KKEY, $data[$key][$kkey]);
						else $to_file[] = sprintf("\t%s['%s/'] = '%s';\n",
							'$direct', $KEY, $data[$key][$kkey]);
				}
			}
		}
		else $to_file[] = sprintf("\t%s['%s/'] = '%s';\n",
			'$direct', $KEY, $data[$key]);
	}

	$to_file[] = sprintf("\n%s%s\n", '?', '>');

	file_put_contents($argv[2], $to_file);
	die();

?>
