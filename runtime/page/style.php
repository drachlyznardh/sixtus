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
	function display_layout_choice ($attr)
	{
		if ($attr['layout'])
		{
			$attr['layout'] = false;
			printf('<em>All-Tabs</em> | <a href="%s">One-Tab</a>',
				make_canonical($attr, $attr['self'], $attr['part']));
		} else {
			$attr['layout'] = true;
			printf('<a href="%s">All-Tabs</a> | <em>One-Tab</em>',
				make_canonical($attr, $attr['self'], $attr['part']));
		}
	}
?>
<div class="section">
	<h3 class="reverse">Theme</h3>
	<p class="reverse">[ <?php display_style_choice ($attr, $style); ?> ]</p>
	<h3>Layout</h3>
	<p>[ <?php display_layout_choice ($attr); ?> ]</p>
</div>
