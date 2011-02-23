<?php if (!isset($multinav)) { ?>
<div class="section">
	<h2>
		Tru Naluten
	</h2><p>
		<?=$d->link('Tru/Naluten/','Indice')?>
	</p><p>
		<?=$d->link('Tru/Naluten/Personaggi','Personaggi')?>
	</p><p>
		<?=$d->link('Tru/Naluten/I/','Volume I')?>
	</p><p>
		<?=$d->link('Tru/Naluten/XX/','Volume III')?>
	</p>
</div>
<?php } ?>
<div class="section">
	<h2 id="arrowvolII-rside" class="opened" onclick="javascript:cascade('volII-rside')">
		Volume II
	</h2><div id="longvolII-rside">
		<ol start="10" style="list-style-type: upper-roman">
			<li><?=$d->link('Tru/Naluten/X/', 'La trovatella'); ?></li>
			<li><?=$d->link('Tru/Naluten/XI/', 'Abbandono &amp; recupero'); ?></li>
			<li><?=$d->link('Tru/Naluten/XII/', 'Conversazione'); ?></li>
			<li><?=$d->link('Tru/Naluten/XIII/', 'Dubbio'); ?></li>
			<li><?=$d->link('Tru/Naluten/XIV/', 'Proposta'); ?></li>
			<li><?=$d->link('Tru/Naluten/XV/', 'La fuga'); ?></li>
			<li><?=$d->link('Tru/Naluten/XVI/', 'La sua gente'); ?></li>
			<li><?=$d->link('Tru/Naluten/XVII/', 'Battaglia navale'); ?></li>
			<li><?=$d->link('Tru/Naluten/XVIII/', 'Duello'); ?></li>
			<li><?=$d->link('Tru/Naluten/XIX/', 'Lezione')?></li>
		</ol>
	</div>
</div>
