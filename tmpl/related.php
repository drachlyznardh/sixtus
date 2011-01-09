<?php
	if (isset($m->prev) || isset($m->index) || isset($m->next) || isset($m->downloadble)) { ?>
	<h2>Pagine collegate</h2>
	<?php if (isset($m->prev))     { ?><p>Precedente: <?=$m->ilink ($m->prev)?></p><?php } ?>
	<?php if (isset($m->index))    { ?><p>Indice:     <?=$m->ilink ($m->index)?></p><?php } ?>
	<?php if (isset($m->next))     { ?><p>Successivo: <?=$m->ilink ($m->next)?></p><?php } ?>
	<?php if (isset($m->downloadable)) { ?><p><a href="<?=$request?>download/">Download</a></p><?php } ?>
</div><div class="section">
<?php } ?>

