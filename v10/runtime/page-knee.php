			</div>
		</div>
		<div id="right-side-panel">
			<div id="right-back"><a href="#" onclick="hide_right_side();">[ &gt; ]</a></div>
			<div class="content"><?php
	if ($d[3]) printf('<div class="inside">Precendente / <a href="%s">%s</a> /</div>', $d[3][0], $d[3][1]);
	printf('<p class="center">/ ');
	$dest = '/';
	foreach ($d[0] as $w) { $dest.=$w.'/'; printf('<a href="%s">%s</a> /', $dest, $w); }
	printf('</p>');
	if ($d[4]) printf('<div class="outside">/ <a href="%s">%s</a> / Successivo</div>', $d[4][0], $d[4][1]);
?>
