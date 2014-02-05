<?php require_once(docroot().'frag/left-nav/content.php');
	frag_left_nav_content($attr, 'section', true); ?>
<div class="section">
	<h3 class="reverse">Theme</h3>
	<p class="reverse">[ <?php
	if ($attr['gray']) printf ('<em>Gray</em>');
	else {
		$custom = array('single' => $attr['single'], 'gray' => true);
		printf ('<a href="%s">Gray</a>',
			make_canonical($custom, $attr['self'], $attr['part']));
	}
	?> | <?php
	if ($attr['gray']) {
		$custom = array('single' => $attr['single'], 'gray' => false);
		printf ('<a href="%s">White</a>',
			make_canonical($custom, $attr['self'], $attr['part']));
	} else printf ('<em>White</em>');
	?> ]</p>
</div>
<div class="spacer"></div>
<?php require_once(docroot().'frag/friends/content.php');
	frag_friends_content($attr, 'section', true); ?>
