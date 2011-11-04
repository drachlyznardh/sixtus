<?php
	$p->addtitle ('Archivio', 'Dove tengo le notizie vecchie');
	$p->addside(function ($d) {
?><div class="section">
	<h2>
		Archivio
	</h2><h2 class="reverse">
		Per anni
	</h2><p>
		2012
		/ <?=$d->link('News/2011/', '2011')?>
	</p><br /><h2 class="reverse">
		Per mesi
	</h2><h3>
		2012
	</h3><p class="reverse">
		Gennaio / Febbraio / Marzo
	</p><p class="reverse">
		Aprile / Maggio / Giugno
	</p><p class="reverse">
		Luglio / Agosto / Settembre
	</p><p class="reverse">
		Ottobre / Novembre / Dicembre
	</p><br /><h3>
		<?=$d->link('News/2011/', '2011')?>
	</h3><p class="reverse">
		<?=$d->link('News/2011/07', 'Luglio')?>
		/ <?=$d->link('News/2011/08/', 'Agosto')?>
		/ <?=$d->link('News/2011/09/', 'Settembre')?>
	</p><p class="reverse">
		<?=$d->link('News/2011/10/', 'Ottobre')?>
		/ <?=$d->link('News/2011/11', 'Novembre')?>
		/ Dicembre
	</p>
</div><?php
	});
	$p->addpage(function ($d) {
?><div class="small">
	<div class="section">
		<h2>
			Archivio
		</h2><p>
			Questo è il luogo dove le notizie vengono archiviate.
		</p><p>
			Tutte le notizie, registrate qui a partire dall'ormai lontano 3
			luglio 2011, sono ricercabili per anno o per mese.
		</p>
	</div>
</div><?php
	});
?>
