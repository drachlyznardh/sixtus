<?php
	printf('<div class="section">');
	if($r['prev'])
	{
		if (is_string($r['prev']))
			list($bf, $addr, $title, $af) = load_page_title($r['prev']);
		else
			list($bf, $addr, $title, $af) = parse_related($r['prev']);

		printf('<div class="inside"><p>');
		printf('/ %s<a href="%s">%s</a>%s / %s',
			$bf, make_canonical($attr, $addr), $title, $af, 'Precedente');
		printf('</p></div>');
	}

	printf ('<p style="text-align: center">');
	display_heading_path($heading);
	printf (' / </p>');

	if ($r['next'])
	{
		if (is_string($r['next']))
			list($bf, $addr, $title, $af) = load_page_title($r['next']);
		else
			list($bf, $addr, $title, $af) = parse_related($r['next']);
		
		printf('<div class="outside"><p class="reverse">');
		printf('%s / %s<a href="%s">%s</a>%s /',
			'Successivo', $bf, make_canonical($attr, $addr), $title, $af);
		printf('</p></div>');
	}
	printf('</div><div class="spacer"></div>');
?>	
