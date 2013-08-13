
<!--
	This file is a fragment for gods.roundhousecode.com
-->

<!-- Sys/Fragments/Related [Start] -->
<div>
<div class="section">
	<?php if(isset($related['prev'])) {
			if (preg_match('/@/', $related['prev'][1])) {
				$_ = preg_split('/@/', $related['prev'][1]);
				switch(count($_))
				{
					case 2: $before = false; $title = $_[0]; $after = $_[1]; break;
					case 3: $before = $_[0]; $title = $_[1]; $after = $_[2]; break;
				}
			} else {
				$before = $after = false;
				$title = $related['prev'][1];
			}
	?>
		<div class="inside"><p>
			/ <?=$before?><a href="<?=make_canonical($attr, $related['prev'][0])?>"><?=$title?></a><?=$after?> / <b><em>Precendente</em></b>
		</p></div>
	<?php } ?>
	<p style="text-align: center">
		/
		<?php if (isset($search['cat'])) foreach ($search['cat'] as $_) { ?>
			<a href="<?=make_canonical($attr, $_[0])?>"><?=$_[1]?></a> / 
		<?php } ?>
	</p>
	<?php if (isset($related['next'])) {
			if (preg_match('/@/', $related['next'][1])) {
				$_ = preg_split('/@/', $related['next'][1]);
				switch(count($_))
				{
					case 2: $before = false; $title = $_[0]; $after = $_[1]; break;
					case 3: $before = $_[0]; $title = $_[1]; $after = $_[2]; break;
				}
			} else {
				$before = $after = false;
				$title = $related['next'][1];
			}
	?>
		<div class="outside"><p class="reverse">
			<b><em>Successivo</em></b> / <?=$before?><a
			href="<?=make_canonical($attr,
			$related['next'][0])?>"><?=$title?></a><?=$after?> /
		</p></div>
	<?php } ?>	
</div>
<br/>
</div>
<!-- Sys/Fragments/Related [Stop] -->

