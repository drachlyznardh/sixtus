<?php dynamic_include($attr, $_SERVER['DOCUMENT_ROOT'].'frag/left-nav.php', true, true);?>
<div class="section">
	<div class="half-left-out"><div class="half-left-in">
			<h3>Tab</h3>
			<p>[
<?php
	if ($attr['single']) printf ('<em>Single</em>');
	else {
		$custom = array('single' => true, 'gray' => $attr['gray']);
		printf ('<a href="%s">Single</a>',
			make_canonical($custom, $attr['self'], $attr['part']));
	}
	printf (' | ');
	if ($attr['single']) {
		$custom = array('single' => false, 'gray' => $attr['gray']);
		printf ('<a href="%s">All</a>',
			make_canonical($custom, $attr['self'], $attr['part']));
	} else printf ('<em>All</em>');
?>
			]</p>
	</div></div>
	<div class="half-right-out"><div class="half-right-in">
			<h3 class="reverse">Theme</h3>
			<p class="reverse">[
<?php
	if ($attr['gray']) printf ('<em>Gray</em>');
	else {
		$custom = array('single' => $attr['single'], 'gray' => true);
		printf ('<a href="%s">Gray</a>',
			make_canonical($custom, $attr['self'], $attr['part']));
	}
	printf (' | ');
	if ($attr['gray']) {
		$custom = array('single' => $attr['single'], 'gray' => false);
		printf ('<a href="%s">White</a>',
			make_canonical($custom, $attr['self'], $attr['part']));
	} else printf ('<em>White</em>');
?>
			]</p>
	</div></div>
	<div style="float:none; clear:both"></div>
</div>
<br />
<?php dynamic_include($attr, $_SERVER['DOCUMENT_ROOT'].'frag/friends.php', true, true);?>
