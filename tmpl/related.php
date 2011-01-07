<?php
	if (isset($related['prev']) || isset($related['index']) || isset($related['next'])) { ?>
	<h2>Pagine collegate</h2>
	<?php if (isset($related['prev']))     { ?><p>Precedente: <?=$m->ilink ($related['prev'])?></p><?php } ?>
	<?php if (isset($related['index']))    { ?><p>Indice:     <?=$m->ilink ($related['index'])?></p><?php } ?>
	<?php if (isset($related['next']))     { ?><p>Successivo: <?=$m->ilink ($related['next'])?></p><?php } ?>
	<?php if (isset($related['download'])) { ?><p><a href="   <?=$request?>download/">Download</a></p><?php } ?>
</div><div class="section">
<?php } ?>

