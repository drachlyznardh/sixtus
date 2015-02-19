<?php

	function load_content($filename)
	{
		require_once($filename);

		if (isset($docroot)) return $docroot;
		return false;
	}

	function deploy_default ()
	{
		return sprintf("\t\treturn %s['%s'].'/';\n",
			'$_SERVER', 'DOCUMENT_ROOT');
	}

	function deploy_one ($data)
	{
		$key = array_keys($data)[0];
		if ($data[$key]) return sprintf("\t\treturn '%s';\n", $data[$key]);
		else return deploy_default();
	}

	function deploy_many ($data)
	{
		$output[] = sprintf("\t\tswitch(%s['%s']) {\n",
			'$_SERVER', 'HTTP_HOST');
		foreach (array_keys($data) as $key)
			if ($data[$key])
				$output[] = sprintf("\t\t\tcase '%s': return '%s/'; break;\n",
					$key, $data[$key]);
		$output[] = sprintf("\t\t\tdefault: return %s['%s'].'/'; break;\n",
			'$_SERVER', 'DOCUMENT_ROOT');
		$output[] = sprintf("\t\t}\n");
	
		return implode($output);
	}

	$data = load_content($argv[1]);
	$output[] = sprintf("%s?php\n\n", '<');
	$output[] = sprintf("\tfunction docroot() {\n");

	if ($data)
		if (count($data) > 1) $output[] = deploy_many($data);
		else $output[] = deploy_one($data);
	else $output[] = deploy_default();

	$output[] = sprintf("\t}\n");
	$output[] = sprintf("\n?%s\n", '>');
	file_put_contents($argv[2], $output);
	die();

?>
