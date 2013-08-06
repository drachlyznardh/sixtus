
<!--
	This file is a fragment for gods.roundhousecode.com
-->

<!-- Sys/Fragments/Related [Start] -->
<div>
<div class="section">
	<?php if(isset($related['prev'])) { ?>
		<div class="inside"><p>
			/ <a href="<?=make_canonical($attr, $related['prev'][0])?>"><?=$related['prev'][1]?></a> / <b><em>Precendente</em></b>
		</p></div>
	<?php } ?>
	<p style="text-align: center">
		/
		<?php foreach ($search['cat'] as $_) { ?>
			<a href="<?=$_[0]?>"><?=$_[1]?></a> / 
		<?php } ?>
	</p>
	<?php if (isset($related['next'])) { ?>
		<div class="outside"><p class="reverse">
			<b><em>Successivo</em></b> / <a href="<?=make_canonical($attr, $related['next'][0])?>"><?=$related['next'][1]?></a> /
		</p></div>
	<?php } ?>	
</div>
<br/>
</div>
<!-- Sys/Fragments/Related [Stop] -->

