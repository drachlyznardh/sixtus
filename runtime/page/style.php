<?php
	function display_style_choice ($attr, $style)
	{
		$i = 0;
		$current = $attr['style'];
		foreach ($style as $target)
		{
			if ($i++) printf(' | ');
			printf('<!-- [%s][%s] -->', $current, $target);
			if (strcmp($current, $target) == 0)
				printf('<em>%s</em>', ucwords($target));
			else {
				$attr['style']= $target;
				printf ('<a href="%s">%s</a>',
					make_canonical($attr, $attr['self'], $attr['part']),
					ucwords($target));
			}
		}
	}
?>
<div class="section">
	<h3 class="reverse">Theme</h3>
	<p class="reverse">[ <?php display_style_choice ($attr, $style); ?> ]</p>
</div>
<div class="section">
	<h3 class="reverse">Theme</h3>
	<p class="reverse">[ <?php
	if ($attr['gray']) printf ('<em>Gray</em>');
	else {
		$custom = array('single' => $attr['single'], 'gray' => true);
		printf ('<a href="%s">Gray</a>',
			make_canonical($custom, $attr['self'], $heading['part'][0]));
	}
	?> | <?php
	if ($attr['gray']) {
		$custom = array('single' => $attr['single'], 'gray' => false);
		printf ('<a href="%s">White</a>',
			make_canonical($custom, $attr['self'], $heading['part'][0]));
	} else printf ('<em>White</em>');
	?> ]</p>
</div>
