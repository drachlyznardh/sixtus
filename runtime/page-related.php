<?php
	printf('<div class="section">');
	if($related['prev'])
	{
		if (preg_match('/@/', $related['prev'][1])) {
			$_ = preg_split('/@/', $related['prev'][1]);
			switch(count($_))
			{
				case 2: $before = false; $title = $_[0]; $after = $_[1]; break;
				case 3: $before = $_[0]; $title = $_[1]; $after = $_[2]; break;
			}
		} else {
			$before = $after = false;
			$title = $related['prev'][1];
		}
		
		printf('<div class="inside"><p>');
		printf('/ %s<a href="%s">%s</a>%s / %s', $before,
			make_canonical($attr, $related['prev'][0]), $title, $after, 'Precedente');
		printf('</p></div>');
	}

	printf ('<p style="text-align: center">');
	display_heading_path($heading);
	printf (' / </p>');

	if ($related['next'])
	{
		if (preg_match('/@/', $related['next'][1])) {
			$_ = preg_split('/@/', $related['next'][1]);
			switch(count($_))
			{
				case 2: $before = false; $title = $_[0]; $after = $_[1]; break;
				case 3: $before = $_[0]; $title = $_[1]; $after = $_[2]; break;
			}
		} else {
			$before = $after = false;
			$title = $related['next'][1];
		}
		
		printf('<div class="outside"><p class="reverse">');
		printf('%s / %s<a href="%s">%s</a>%s /',
			'Successivo', $before,
			make_canonical($attr, $related['next'][0]), $title, $after);
		printf('</p></div>');
	}
	printf('</div><br/>');
?>	
