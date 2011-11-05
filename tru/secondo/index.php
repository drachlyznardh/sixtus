<?php
	$p->addtitle ('Volume II', 'Con Jo, la piccola fioraia innocente');
	$p->addprev ('Tru/Naluten/Vol.I/', 'Volume I');
	$p->addnext ('Tru/Naluten/Vol.III/', 'Volume III');
	$p->addpage(function ($d) {
?><div class="small">
	<div class="section">
		<h2>
			Volume II
		</h2><p>
			Simak recluta Jo come suo araldo, e la manda a fare la profetessa presso alcuni
			ribelli che si battono per la libertà contro certi alcuni oppressori giunti
			dall'altro lato dell'oceano...
		</p>
	</div>
</div><?php 
	});
	$p->addside (function ($d) { 
?><div class="section">
	<h2>
		Volume II
	</h2><ol start="10">
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
</div><?php 
	});
?>
