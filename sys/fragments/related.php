
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
	<p>
		Culo.Right-Side
	</p> 
	<?php if (isset($related['next'])) { ?>
		<div class="outside"><p class="reverse">
			<b><em>Successivo</em></b> / <a href="<?=make_canonical($attr, $related['next'][0])?>"><?=$related['next'][1]?></a> /
		</p></div>
	<?php } ?>	
</div>
</div>
<!-- Sys/Fragments/Related [Stop] -->

