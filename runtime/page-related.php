<?php
	printf('<div class="section">');
	if($r['prev'])
	{
		if (preg_match('/@/', $r['prev'][1])) {
			$_ = preg_split('/@/', $r['prev'][1]);
			switch(count($_))
			{
				case 2: $before = false; $title = $_[0]; $after = $_[1]; break;
				case 3: $before = $_[0]; $title = $_[1]; $after = $_[2]; break;
			}
		} else {
			$before = $after = false;
			$title = $r['prev'][1];
		}
		
		printf('<div class="inside"><p>');
		printf('/ %s<a href="%s">%s</a>%s / %s', $before,
			make_canonical($attr, $r['prev'][0]), $title, $after, 'Precedente');
		printf('</p></div>');
	}

	printf ('<p style="text-align: center">');
	display_heading_path($heading);
	printf (' / </p>');

	if ($r['next'])
	{
		if (preg_match('/@/', $r['next'][1])) {
			$_ = preg_split('/@/', $r['next'][1]);
			switch(count($_))
			{
				case 2: $before = false; $title = $_[0]; $after = $_[1]; break;
				case 3: $before = $_[0]; $title = $_[1]; $after = $_[2]; break;
			}
		} else {
			$before = $after = false;
			$title = $r['next'][1];
		}
		
		printf('<div class="outside"><p class="reverse">');
		printf('%s / %s<a href="%s">%s</a>%s /',
			'Successivo', $before,
			make_canonical($attr, $r['next'][0]), $title, $after);
		printf('</p></div>');
	}
	printf('</div><div class="spacer"></div>');
?>	
