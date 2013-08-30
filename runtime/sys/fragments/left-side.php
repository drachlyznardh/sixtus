
<!--
	This file is a fragment for gods.roundhousecode.com
-->

<!-- Sys/Fragments/Left-Side [Start] -->
<div>
<?php dynamic_include($attr, 'frag/left-side-fragment.php', 'content', true);?>
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
<div class="section">
	<h2><span class="em" title="“Un po&apos; culattoni?” “No, no, solo allegri”">Allegri</span> compagni</h2>
	<p>
		Le <a href="http://kiyuko.org/blog/">idee</a> del <span
		class="bolo">Bolo</span>, le <a
		href="http://dacav.roundhousecode.com/">seghe</a> di <span
		class="dacav">Simgi Dacav</span>, le <a
		href="http://mikezasch.wordpress.com/">lamentele</a> di <span
		class="mitch">Mitch</span>, le <a
		href="http://jazzinghen.wordpress.com/">opinioni</a> di <span
		class="jazz">Jazzinghen</span> e le <em>nuove</em> <a
		href="https://plus.google.com/communities/117214031469177046669">cose fighe</a> del <em>Barone</em>.
	</p>
</div>
</div>
<!-- Sys/Fragments/Left-Side [Stop] -->

