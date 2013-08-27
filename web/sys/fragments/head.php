
<!--
	This file is a fragment for gods.roundhousecode.com
-->

<!-- Sys/Fragments/Head [Start] -->
<div class="section">
	<div class="inside em"><p style="text-align:center">
		<a href="http://gods.roundhousecode.com">Gods</a> .
		<a href="http://roundhousecode.com">RoundhouseCode</a> .
		<a href="http://roundhousecode.com">com</a> /
		<br class="small-screen"/>
		<?php if (isset($search['cat'])) foreach ($search['cat'] as $_) {?>
			<a href="<?=make_canonical($attr, $_[0])?>"><?=$_[1]?></a> / 
		<?php }
		if (isset($search['page'])) {
			echo ('<a href="'.make_canonical($attr, $search['page'][0]).'">'.$search['page'][1].'</a> ');
			if ($attr['part'])
				echo ('§ <a href="'.make_canonical($attr, $search['page'][0], $attr['part']).'">'.strtoupper($attr['part']).'</a>');
			echo ('/');
		} ?>
	</p></div><h1 style="text-align:center">
		<?=$attr['title']?>
	</h1><div class="outside em"><p style="text-align: center">
			<?=$attr['subtitle']?>
	</p></div>
</div>
<!-- Sys/Fragments/Head [Stop] -->

