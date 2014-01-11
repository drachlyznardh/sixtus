
<!--
	This file is a fragment for gods.roundhousecode.com
-->

<!-- Sys/Fragments/Head [Start] -->
<div class="section">
	<div class="inside em"><p style="text-align:center">
		<a href="http://gods.roundhousecode.com">Gods</a> .
		<a href="http://roundhousecode.com">RoundhouseCode</a> .
		<a href="http://roundhousecode.com">com</a>
		<br class="small-screen"/>
		<?php foreach ($request['path'] as $_) {
			$current = ucwords($_);
			$cumulative[] = $current;
			printf(' / <a href="%s/">%s</a>',
				make_canonical($attr, implode('/', $cumulative)), $current);
		}
		if ($attr['part'])
			printf(' § <a href="%s§%s/">%s</a>',
				make_canonical($attr, implode('/', $cumulative)),
				$attr['part'], strtoupper($attr['part']));
		?> /
	</p></div><h1 style="text-align:center">
		<?=$attr['title']?>
	</h1><div class="outside em"><p style="text-align: center">
			<?=$attr['subtitle']?>
	</p></div>
</div>
<!-- Sys/Fragments/Head [Stop] -->

