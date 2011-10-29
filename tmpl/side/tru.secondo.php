<?php if (!isset($multinav)) { ?>
<div class="section">
	<h2>
		Tru Naluten
	</h2><p>
		<?=$d->link('Tru/Naluten/','Indice')?>
	</p><p>
		<?=$d->link('Tru/Naluten/Personaggi','Personaggi')?>
	</p><p>
		<?=$d->link('Tru/Naluten/Vol.I/I/','Volume I')?>
	</p><p>
		<?=$d->link('Tru/Naluten/Vol.III/XX/','Volume III')?>
	</p>
</div>
<?php } ?>
<div class="section">
	<h2 id="arrowvolII-rside" class="opened" onclick="javascript:cascade('volII-rside')">
		Volume II
	</h2><div id="longvolII-rside">
		<ol start="10" style="list-style-type: upper-roman">
			<li><?=$d->link('Tru/Naluten/Vol.II/X/', 'La trovatella'); ?></li>
			<li><?=$d->link('Tru/Naluten/Vol.II/XI/', 'Abbandono &amp; recupero'); ?></li>
			<li><?=$d->link('Tru/Naluten/Vol.II/XII/', 'Conversazione'); ?></li>
			<li><?=$d->link('Tru/Naluten/Vol.II/XIII/', 'Dubbio'); ?></li>
			<li><?=$d->link('Tru/Naluten/Vol.II/XIV/', 'Proposta'); ?></li>
			<li><?=$d->link('Tru/Naluten/Vol.II/XV/', 'La fuga'); ?></li>
			<li><?=$d->link('Tru/Naluten/Vol.II/XVI/', 'La sua gente'); ?></li>
			<li><?=$d->link('Tru/Naluten/Vol.II/XVII/', 'Battaglia navale'); ?></li>
			<li><?=$d->link('Tru/Naluten/Vol.II/XVIII/', 'Duello'); ?></li>
			<li><?=$d->link('Tru/Naluten/Vol.II/XIX/', 'Lezione')?></li>
		</ol>
	</div>
</div>
