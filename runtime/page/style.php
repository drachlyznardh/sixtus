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
