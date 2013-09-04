
<!--
	This file is a fragment for gods.roundhousecode.com
-->

<!-- Sys/Fragments/Left-Side [Start] -->
<div>
<?php dynamic_include($attr, 'frag/left-nav.php', true, true);?>
<div class="section">
	<!--div style="width:50%; float:left"><div class="inside"-->
	<div class="half-left-out"><div class="half-left-in">
			<h3>Tab</h3>
			<p>
				<!---Tab -->[ <?php
	if ($attr['single']) {
		echo ('<em>Single</em>');
	} else {
		$custom = array('single' => true, 'gray' => $attr['gray']);
		$url = make_canonical($custom, $attr['self'], $attr['part']);
		echo ('<a href="'.$url.'">Single</a>');
	}
				?> | <?php
	if ($attr['single']) {
		$custom = array('single' => false, 'gray' => $attr['gray']);
		$url = make_canonical($custom, $attr['self'], $attr['part']);
		echo ('<a href="'.$url.'">All</a>');
	} else {
		echo('<em>All</em>');
	}
				?> ]
			</p>
	</div></div>
	<!--div style="width:50%; float:right"><div class="outside"-->
	<div class="half-right-out"><div class="half-right-in">
			<h3 class="reverse">Theme</h3>
			<p class="reverse">
				[ <?php
	if ($attr['gray']) {
		echo ('<em>Gray</em>');
	} else {
		$custom = array('single' => $attr['single'], 'gray' => true);
		$url = make_canonical($custom, $attr['self'], $attr['part']);
		echo ('<a href="'.$url.'">Gray</a>');
	}
				?> | <?php
	if ($attr['gray']) {
		$custom = array('single' => $attr['single'], 'gray' => false);
		$url = make_canonical($custom, $attr['self'], $attr['part']);
		echo ('<a href="'.$url.'">White</a>');
	} else {
		echo ('<em>White</em>');
	}
				?> ] <!--Theme-->
			</p>
	</div></div>
	<div style="float:none; clear:both"></div>
</div>
<br />
<?php dynamic_include($attr, 'frag/friends.php', true, true);?>
</div>
<!-- Sys/Fragments/Left-Side [Stop] -->

