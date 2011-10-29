<?php if (isset($multinav) && $multinav); else echo ('<div class="section">'); ?>
	<h2 class="reverse">
		2011
	</h2><p>
		<?=$d->link('News/2011/07/','Luglio')?>
		| <?=$d->link('News/2011/08/','Agosto')?>
		| <?=$d->link('News/2011/09/','Settembre')?>
	</p><p>
		<?=$d->link('News/2011/10/', 'Ottobre')?>
		| Novembre | Dicembre
	</p>
<?php if (isset($multinav) && $multinav); else echo ('</div>'); ?>
