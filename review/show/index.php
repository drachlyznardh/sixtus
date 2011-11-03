<?php
	$title = array ('Show', 'Perché io vedo moltissima TV (attraverso il web)');
	$pages[] = function ($d) {
?>
<div class="small">
	<?php if ($d->mktab('') or $d->mktab('categorie')) { ?><div class="section">
		<h2><a id="Show"></a><a id="Show"></a>
			Show
		</h2><p>
			Ora che abbiamo l'internet, procurarsi roba molto nuova o molto
			vecchia è diventato estremamente più semplice di una volta.
		</p><p>
			È questo il principale motivo per cui esiste questa sezione, perché
			ora sono in grado di andare a cercare quel che voglio vedere e
			vedermelo.
		</p>
	</div><?php } ?>
</div>
<?php
	};
	$sides[] = function ($d) {
?>
<div class="section">
	<h2 class="reverse">
		Show
	</h2><p>
		IV. <?=$d->link('Recensioni/Show/IV/', 'Pani Poni Dash')?> – 2005
	</p><p>
		V. <?=$d->link('Recensioni/Show/V/', 'BlassReiter')?> – 2008
	</p><p>
		VI. <?=$d->link('Recensioni/Show/VI/', 'Masterforce')?> – 1988
	</p><p>
		IX. <?=$d->link('Recensioni/Show/IX/', 'Angel Beats!')?> – 2010
	</p><p>
		XIII. <?=$d->link('Recensioni/Show/XIII/', 'Kamen Rider')?> – 1971~2011
	</p><p>
		XIV. <?=$d->link('Recensioni/Show/XIV/', 'Gundam AGE')?> – 2011
	</p><p>
		XV. <?=$d->link('Recensioni/Show/XV/', 'TransFormers: Prime')?> – 2011
	</p>
</div>
<?php } ?>
